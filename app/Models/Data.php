<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'uniq_id',
        'csvfile',
        'jumlah',
        'range',
        'random'
    ];
}
