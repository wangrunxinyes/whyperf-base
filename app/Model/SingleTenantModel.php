<?php

namespace App\Model;

use Whyperf\MultiTenant\MultiTenantModel;

class SingleTenantModel extends Model
{
    protected $table = "audit";
}