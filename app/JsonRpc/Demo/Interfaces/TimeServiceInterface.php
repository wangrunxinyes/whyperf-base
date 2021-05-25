<?php

namespace App\JsonRpc\Demo\Interfaces;

/**
 * Interface TimeServiceInterface
 * @package App\JsonRpc\Demo\Interfaces
 */
interface TimeServiceInterface
{
    public function getTime(): string;

}