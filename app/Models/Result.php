<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $connection  = 'mysql_edu';
    protected $table = 'results';
    protected $fillable = [
        'topic_id',
        'user_id',
        'num_correct',
        'num_incorrect',
        'result'
    ];
}
