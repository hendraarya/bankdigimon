<?php

namespace App\Models\bankrubber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPlanningRb45l2 extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'backup_planrubber_45l2';

    protected $guarded = [];
}
