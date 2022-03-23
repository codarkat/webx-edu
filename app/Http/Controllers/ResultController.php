<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ResultController extends Controller
{
    public function store(Request $request){
        if(Result::where('user_id', Auth::user()->id)
            ->where('topic_id', $request->input('topic_id'))->get()->count()){
            return response()->json(['code' => 2]);
        } else {
            $result = new Result();
            $result->topic_id = $request->input('topic_id');
            $result->user_id = Auth::user()->id;
            if($result->save()){
                return response()->json(['code' => 1]);
            } else {
                return response()->json(['code' => 0]);
            }
        }
    }

    public function check(Request $request){
        $result = Result::where('user_id', Auth::user()->id)->where('topic_id', $request->input('topic_id'))->first();
        if($result != null){
            return response()->json(['status' => $result->status]);
        } else {
            return response()->json(['status' => null]);
        }
    }

    public function update(Request $request){
        $num_correct = 0;
        $num_incorrect = 0;
        $result = [];
        $data = $request->all();
        for($i = 1; $i <= $data['num_question']; $i++){
            if($data['question_type_'.$i] == 'FORM'){
                $isCorrect = false;
                if($data['answer_'.$data['question_id_'.$i]] != ''){
                    $q = Answer::where('question_id',$data['question_id_'.$i])->first();
//                    if($q->answer == $data['answer_'.$data['question_id_'.$i]]){
//                    if(in_array($data['answer_'.$data['question_id_'.$i]], json_decode($q->answer), true)){
                    if(in_array(strtolower($data['answer_'.$data['question_id_'.$i]]), array_map('strtolower', json_decode($q->answer)), true)){
                        $isCorrect = true;
                        $answer = $data['answer_'.$data['question_id_'.$i]];
                        $num_correct++;
                    } else {
                        $answer = $data['answer_'.$data['question_id_'.$i]];
                        $num_incorrect++;
                    }
                } else {
                    $answer = null;
                    $num_incorrect++;
                }
                array_push($result, [
                    'question_id' => $data['question_id_'.$i],
                    'question_type' => $data['question_type_'.$i],
                    'answer'=> $answer,
                    'isCorrect' => $isCorrect
                ]);
            } else if($data['question_type_'.$i] == 'CHOICE'){
                $isCorrect = false;
                if(isset($data['option_answer_'.$data['question_id_'.$i]])){
                    $q = Answer::where('question_id',$data['question_id_'.$i])->first();
                    if($q->answer == $data['option_answer_'.$data['question_id_'.$i]]){
                        $isCorrect = true;
                        $answer = $data['option_answer_'.$data['question_id_'.$i]];
                        $num_correct++;
                    } else {
                        $answer = $data['option_answer_'.$data['question_id_'.$i]];
                        $num_incorrect++;
                    }
                } else {
                    $answer = null;
                    $num_incorrect++;
                }
                array_push($result, [
                    'question_id' => $data['question_id_'.$i],
                    'question_type' => $data['question_type_'.$i],
                    'answer'=> $answer,
                    'isCorrect' => $isCorrect
                ]);

                //echo $data['option_answer_'.$data['question_id_'.$i]];
                //echo 'CHOICE';
            } else if($data['question_type_'.$i] == 'MULTIPLE_CHOICE'){
                if(isset($data['option_answer_'.$data['question_id_'.$i]])){
                    $isCorrect = false;
                    $q = Answer::where('question_id',$data['question_id_'.$i])->first();
                    $arrayAnswers = [];
                    foreach ($data['option_answer_'.$data['question_id_'.$i]] as $answer){
                        array_push($arrayAnswers, $answer);
                    }
                    if($arrayAnswers === json_decode($q->answer)){
                        $isCorrect = true;
                        $answer = $arrayAnswers;
                        $num_correct++;
                    } else {
                        $answer = $arrayAnswers;
                        $num_incorrect++;
                    }
                } else {
                    $answer = null;
                    $num_incorrect++;
                }
                array_push($result, [
                    'question_id' => $data['question_id_'.$i],
                    'question_type' => $data['question_type_'.$i],
                    'answer'=> $answer,
                    'isCorrect' => $isCorrect
                ]);
            }
        }
        $result_user = Result::where('user_id', Auth::user()->id)->where('topic_id', $request->input('topic_id'))->first();
        $result_user->num_correct = $num_correct;
        $result_user->num_incorrect = $num_incorrect;
        $result_user->result = json_encode($result);
        $result_user->status = 'FINISHED';
        $result_user->data = json_encode($data);
        if($result_user->save()){
            return redirect()->route('user.list-results');
        }else{
            return abort(404);
        }
    }

    public function getResult(Request $request){
        if($request->input('user_id') !== null){
            $result = Result::where('topic_id',$request->input('topic_id'))->where('user_id',$request->input('user_id'))->first();
        } else {
            $result = Result::where('topic_id',$request->input('topic_id'))->where('user_id',Auth::user()->id)->first();
        }
        return response()->json(['result' => $result]);
    }

    public function getAll(Request $request){
        if ($request->ajax()) {
            $results = Result::where('status', 'FINISHED')->get();
            return Datatables::of($results)
                ->addIndexColumn()
                ->editColumn('name', function($result){
                    return $result->user->name;
                })
                ->editColumn('topic', function ($result) {
                    return $result->topic->name;
                })
                ->addColumn('action', function($result){
                    return '
                            <a type="button" class="btn btn-warning ajax-view-result" data-topic-id="'.$result->topic_id.'" data-user-id="'.$result->user_id.'"><i class="material-icons">visibility</i>Xem kết quả</a>

                    ';
                })
                ->rawColumns(['name', 'topic', 'action'])
                ->make(true);
        }
    }

    public function getUserResults(Request $request, $user_id){
        if ($request->ajax()) {
            $results = Result::where('status', 'FINISHED')->where('user_id', $user_id)->get();
            return Datatables::of($results)
                ->addIndexColumn()
                ->editColumn('topic', function ($result) {
                    return $result->topic->name;
                })
                ->addColumn('action', function($result){
                    return '
                            <a type="button" class="btn btn-warning ajax-view-result" data-topic-id="'.$result->topic_id.'" data-user-id="'.$result->user_id.'"><i class="material-icons">visibility</i>Xem kết quả</a>

                    ';
                })
                ->rawColumns(['topic', 'action'])
                ->make(true);
        }
    }

    public function getClock($topic_id){
        $result = Result::where('topic_id',$topic_id)->where('user_id',Auth::user()->id)->first();
        $topic = Topic::find($topic_id);
        $create_at = $result->created_at;
        $clock = date('Y-m-d H:i:s', strtotime($create_at. ' +'.$topic->duration.' minutes'));
        return response()->json(['clock' => $clock]);
    }
}
