<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $connection  = 'mysql_edu';
    protected $table = 'questions';
    protected $fillable = [
        'content',
        'topic_id',
        'type',
        'status'
    ];
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
}
