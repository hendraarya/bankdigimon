<?php

namespace App\Models\bankrubber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPlanningRb20l3 extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'backup_planrubber_20l3';

    protected $guarded = [];
}
