<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Question;
use App\Models\Result;
use App\Models\Subscribe;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function exam($id){
        $result = Result::where('topic_id',$id)->where('user_id',Auth::user()->id)->first();
        if($result == null || $result->status == 'FINISHED' || $this->checkTimeExpired($id)){
            return abort(404);
        }
        $topic = Topic::find($id);
        $questions = Question::where('topic_id',$topic->id)->get();
        return view('main.exam', [
            'questions' => $questions,
            'topic' => $topic,
        ]);
    }

    public function result($id){
        $result = Result::where('topic_id',$id)->where('user_id',Auth::user()->id)->first();
        if(!isset($result) || $this->checkTimeExpired($id)){
            return abort(404);
        }
        $topic = Topic::find($id);
        $questions = Question::where('topic_id',$topic->id)->get();
        return view('main.result', [
            'questions' => $questions,
            'topic' => $topic,
            'result' => $result,
        ]);
    }

    public function checkTimeExpired($topic_id){
        $topic = Topic::find($topic_id);
        $result = Result::where('topic_id',$topic_id)
            ->where('user_id',Auth::user()->id)
            ->where('status','PROCESSING')->first();
        if(!isset($result)){
            return false;
        }
        $create_at = $result->created_at;
        $clock = date('Y-m-d H:i:s', strtotime($create_at. ' +'.$topic->duration.' minutes'));
        $now = date("Y-m-d H:i:s");
        if(strtotime($now) > strtotime($clock)){
            return true;
        } else {
            return false;
        }
    }

    public function listResults(){
        return view('main.list-results');
    }

    public function topics(){
        $topics = Topic::where('status', StatusEnum::ACTIVE)
                        ->where('num_question', '>', 0)->get();
        $subscribes = Subscribe::where('user_id', Auth::user()->id)->get();
        $results = Result::where('user_id', Auth::user()->id)->get();
        $results_processing = Result::where('user_id', Auth::user()->id)
            ->where('status', 'PROCESSING')->get();
        $results_finished = Result::where('user_id', Auth::user()->id)
            ->where('status', 'FINISHED')->get();

        $array_subscribe = [];
        $array_result = [];
        $array_result_processing = [];
        $array_result_finished = [];
        $array_result_expired = [];

        foreach ($subscribes as $subscribe){
            array_push($array_subscribe, $subscribe->topic_id);
        }
        foreach ($results as $result){
            array_push($array_result, $result->topic_id);
        }
//        foreach ($results_processing as $result_processing){
//            array_push($array_result_processing, $result_processing->topic_id);
//        }
        foreach ($results_finished as $result_finished){
            array_push($array_result_finished, $result_finished->topic_id);
        }

        foreach ($results_processing as $result_processing){
            $topic = Topic::find($result_processing->topic_id);
            $create_at = $result_processing->created_at;
            $clock = date('Y-m-d H:i:s', strtotime($create_at. ' +'.$topic->duration.' minutes'));
            $now = date("Y-m-d H:i:s");
            if(strtotime($now) > strtotime($clock)){
                array_push($array_result_expired, $result_processing->topic_id);
            } else {
                array_push($array_result_processing, $result_processing->topic_id);
            }
        }

        return view('main.topics', [
            'topics' => $topics,
            'subscribes' => $array_subscribe,
            'results' => $array_result,
            'results_processing' => $array_result_processing,
            'results_finished' => $array_result_finished,
            'results_expired' => $array_result_expired,
        ]);
    }


}
