<?php

namespace App\Service\Demo;

use App\JsonRpc\Demo\Interfaces\CalculatorServiceInterface;

/**
 * Class CalculatorService
 * @package App\Service\Demo
 * @author WANG RUNXIN
 * @\App\JsonRpc\Demo\DemoMS()
 */
class CalculatorService implements CalculatorServiceInterface
{
    // 实现一个加法方法，这里简单的认为参数都是 int 类型
    public function sum(int $v1, int $v2): int
    {
        // 这里是服务方法的具体实现
        return $v1 + $v2;
    }

}