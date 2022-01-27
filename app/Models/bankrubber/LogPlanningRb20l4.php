<?php

namespace App\Models\bankrubber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPlanningRb20l4 extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'backup_planrubber_20l4';

    protected $guarded = [];
}
