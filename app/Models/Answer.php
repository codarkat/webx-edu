<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $connection  = 'mysql_edu';
    protected $table = 'answers';
    protected $fillable = [
        'answer',
        'option_answer',
        'question_id'
    ];
//    public function question()
//    {
//        return $this->belongsTo(Question::class, 'question_id');
//    }
}
