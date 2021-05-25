<?php

namespace App\Service\DemoTwo;

use App\JsonRpc\Demo\Interfaces\TimeServiceInterface;
use App\JsonRpc\DemoTwo\Interfaces\DateServiceInterface;
use App\Model\MultiTenantTester;

/**
 * Class TimeService
 * @package App\Service\Demo
 * @author WANG RUNXIN
 * @\App\JsonRpc\DemoTwo\DemoTwo()
 */
class DateService implements DateServiceInterface
{

    function getDate($time): string
    {
        $model = MultiTenantTester::query(true)->where("id", 1)->first();
        return date("Y-m-d H:i:s", $time);
    }
}