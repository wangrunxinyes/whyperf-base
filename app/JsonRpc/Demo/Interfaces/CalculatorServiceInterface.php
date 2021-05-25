<?php

namespace App\JsonRpc\Demo\Interfaces;

/**
 * Interface CalculatorServiceInterface
 * @package App\JsonRpc\Demo\Interfaces
 */
interface CalculatorServiceInterface
{
    public function sum(int $v1, int $v2): int;

}