<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $topics = Topic::all();
        return view('admin.dashboard', [
            'topics' => $topics,
        ]);
    }

    public function topicDetails($id){
        $topic = Topic::find($id);
        $questions = Question::where('topic_id',$topic->id)->get();
        return view('admin.topic-details', [
            'questions' => $questions,
            'topic' => $topic,
        ]);
    }
}
