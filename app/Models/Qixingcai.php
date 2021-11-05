<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qixingcai extends Model
{
    use HasFactory;

    protected $table = 'qixingcai';

    protected $timestamps = false;

    protected $fillable = [
        'id',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'post_time',
        'created_at',
    ];
}
