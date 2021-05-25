<?php

namespace App\JsonRpc\Demo\Client;

use App\JsonRpc\Demo\DemoMS;
use App\JsonRpc\Demo\Interfaces\CalculatorServiceInterface;
use Whyperf\Rpc\Annotation\AbstractMicroService;
use Whyperf\Rpc\Model\AbstractRpcClient;

/**
 * Class CalculatorServiceConsumer
 * @package App\JsonRpc\Demo\Client
 * @author WANG RUNXIN
 */
class CalculatorServiceConsumer extends AbstractRpcClient implements CalculatorServiceInterface
{
    public function sum(int $v1, int $v2): int
    {
        $result = $this->__request(__FUNCTION__, compact('v1', 'v2'));
        if (is_int($result)) {
            return $result;
        }

        return 0;
    }

    function getService(): AbstractMicroService
    {
        return new DemoMS();
    }
}