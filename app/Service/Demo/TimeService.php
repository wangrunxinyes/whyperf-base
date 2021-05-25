<?php

namespace App\Service\Demo;

use App\JsonRpc\Demo\Interfaces\TimeServiceInterface;

/**
 * Class TimeService
 * @package App\Service\Demo
 * @author WANG RUNXIN
 * @\App\JsonRpc\Demo\DemoMS()
 */
class TimeService implements TimeServiceInterface
{
    public function getTime(): string
    {
        return time();
    }
}