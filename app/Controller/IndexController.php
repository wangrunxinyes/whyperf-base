<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;


use App\JsonRpc\Demo\Interfaces\CalculatorServiceInterface;
use App\JsonRpc\Demo\Interfaces\TimeServiceInterface;
use App\JsonRpc\DemoTwo\Interfaces\DateServiceInterface;
use App\Model\MultiTenantTester;
use App\Model\SingleTenantModel;
use App\Request\Demo\IndexController\IndexRequest;
use App\Request\FooRequest;
use Hyperf\Database\Model\Model;
use Hyperf\DbConnection\Db;
use Hyperf\Utils\WaitGroup;
use Monolog\Logger;
use Whyperf\Controller\BaseController;
use Whyperf\MultiTenant\DbConnection\Connection;
use Whyperf\MultiTenant\Middleware\MultiTenantMW;
use Whyperf\MultiTenant\MultiTenantAuthenticator;
use Whyperf\System\CoroutineEnv\CoreGo;
use Whyperf\Tracker\Tracker;
use Whyperf\Whyperf;

class IndexController extends BaseController
{
    public function index(IndexRequest $request)
    {

        $user = $this->getRequest()->input('user', 'Hyperf');
        $method = $this->getRequest()->getMethod();

        $client = Whyperf::getContainer()->get(CalculatorServiceInterface::class);

        $sum = $client->sum(intval($this->getRequest()->input('amount', 1)), 2);

        $client = Whyperf::getContainer()->get(DateServiceInterface::class);

        $time = $client->getDate(time());

        $tenantId = 0;

        /**
         * @var Tracker $tracker
         */
        $tracker = CoreGo::getInstance()->setMainCore()->getComponent(Tracker::class);


        $coroutineKey = null;
        $secondaryKey = null;
        co(function () use (&$coroutineKey) {
            $coroutineKey = CoreGo::getInstance()->getKey();
        });

        $model = new MultiTenantTester();
        $model->getConnection();

        $model = new SingleTenantModel();
        $model->getConnection();

        $coreGoKey = null;
        $innerTraceId = null;
        $tenantId = MultiTenantAuthenticator::getInstance()->getTenantId();
        CoreGo::Run(function () use (&$coreGoKey, &$secondaryKey, &$innerTraceId, &$tenantId) {
            CoreGo::Run(function () use (&$secondaryKey, &$innerTraceId) {
                $secondaryKey = CoreGo::getInstance()->getKey();
            });
            $coreGoKey = CoreGo::getCoreGo()->getKey();
            $innerTraceId = Tracker::getInstance()->getTraceId();
            $tenantId = MultiTenantAuthenticator::getInstance()->getTenantId();
            CoreGo::getCoreGo()->setKey("changed");
        }, true);

        $changedKey = CoreGo::getCoreGo()->getKey();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'result' => $sum,
            'tenant' => $tenantId,
            "keys" => [
                "tracker" => [
                    $tracker->getTraceId(),
                    $innerTraceId,
                ],
                $coroutineKey,
                $secondaryKey,
                $coreGoKey,
                $changedKey
            ],
            'time' => $time,
        ];
    }

    public function model()
    {
        Whyperf::getLogger("testCategory")->log(Logger::ERROR, "test error log");
        $users = Connection::table('customer')
            ->orderBy('name', 'desc')
            ->get();

        $model = MultiTenantTester::query(true)->where("id", 1)->first();

        Connection::table('customer')
            ->disableTrace()
            ->insert([
                [
                    "name" => uniqid(),
                ],
                [
                    "name" => uniqid(),
                ]
                , [
                    "name" => uniqid(),
                ]
            ]);

//        SingleTenantModel::query(true)->where("id", 1)->first();

        return [
            "result" => "success",
            "user" => $users,
            "model" => $model
        ];
    }
}
