<?php

namespace App\JsonRpc\Demo\Client;

use App\JsonRpc\Demo\DemoMS;
use App\JsonRpc\Demo\Interfaces\CalculatorServiceInterface;
use App\JsonRpc\Demo\Interfaces\TimeServiceInterface;
use Whyperf\Rpc\Annotation\AbstractMicroService;
use Whyperf\Rpc\Model\AbstractRpcClient;

/**
 * Class TimeServiceConsumer
 * @package App\JsonRpc\Demo\Client
 * @author WANG RUNXIN
 */
class TimeServiceConsumer extends AbstractRpcClient implements TimeServiceInterface
{
    function getService(): AbstractMicroService
    {
        return new DemoMS();
    }

    public function getTime(): string
    {
        $result = $this->__request(__FUNCTION__, []);
        if (is_string($result)) {
            return $result;
        }

        return "error";
    }
}