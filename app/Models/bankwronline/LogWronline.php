<?php

namespace App\Models\bankwronline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogWronline extends Model
{
    use HasFactory;

    protected $connection = 'wronline';
    protected $table = 'xwr';

    protected $guarded = [];
}
