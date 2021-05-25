<?php

namespace App;

use Whyperf\MultiTenant\Middleware\MultiTenantMW;
use Whyperf\System\AbstractSystemConfig;
use Whyperf\Tracker\Tracker;

class App extends AbstractSystemConfig
{

    function getCoreGoComponents(): array
    {
        return [
            Tracker::class,
        ];
    }

    function getLazyCoreGoComponents(): array
    {
        return [
            MultiTenantMW::class,
        ];
    }

    function getAuditSamplingRate(): int
    {
        return 0;
    }
}