<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Question;
use App\Models\Subscribe;
use App\Models\Topic;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function exam($id){
        $topic = Topic::find($id);
        $questions = Question::where('topic_id',$topic->id)->get();
        return view('main.exam', [
            'questions' => $questions,
            'topic' => $topic,
        ]);
    }

    public function topics(){
        $topics = Topic::where('status', StatusEnum::ACTIVE)
                        ->where('num_question', '>', 0)->get();
        $subscribes = Subscribe::where('user_id', 1)->get();
        $array_subscribe = [];
        foreach ($subscribes as $subscribe){
            array_push($array_subscribe, $subscribe->topic_id);
        }
        return view('main.topics', [
            'topics' => $topics,
            'subscribes' => $array_subscribe,
        ]);
    }
}
