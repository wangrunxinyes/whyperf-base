<?php

namespace App\JsonRpc\DemoTwo\Interfaces;

/**
 * Interface DateServiceInterface
 * @package App\JsonRpc\DemoTwo\Interfaces
 * @author WANG RUNXIN
 */
interface DateServiceInterface
{
    function getDate($time): string;
}