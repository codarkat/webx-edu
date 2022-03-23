<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'content'=>'required',
            'type'=>'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $question = new Question();
            $question->content = $request->input('content');
            $question->topic_id = $request->input('topic_id');
            $question->type = $request->input('type');
            $question->status = 'ACTIVE';
            if($question->save()){
                $topic = Topic::find($request->input('topic_id'));
                $topic->num_question += 1;
                $topic->save();
                $answer = new Answer();
                if($request->input('type') == 'MULTIPLE_CHOICE' || $request->input('type') == 'FORM'){
                    $answer->answer = json_encode($request->input('answer'));
                } else {
                    $answer->answer = $request->input('answer');
                }
                $answer->question_id = $question->id;
                if($request->input('option_answer') !== null) {
                    $answer->option_answer = json_encode($request->input('option_answer'));
                }
                if($answer->save()){
                    $status = '<span class="badge badge-success">Mở</span>';
                    $action = '
                            <a type="button" class="btn btn-warning ajax-edit-question" data-bs-toggle="modal" data-bs-target="#modal-edit-question" data-id="'.$question->id.'"><i class="material-icons">edit</i>Sửa</a>
                            <a type="button" class="btn btn-danger ajax-delete-question" data-id="'.$question->id.'"><i class="material-icons">delete_outline</i>Xóa</a>
                    ';
                    return response()->json([
                        'code' => 1,
                        'content' => $request->input('content'),
                        'status' => $status,
                        'action' => $action,
                        'type' => $request->input('type')
                    ]);
                } else {
                    return response()->json(['code' => 0]);
                }
            } else {
                return response()->json(['code' => 0]);
            }
        }
    }
    public function update(Request $request){
        $id = $request->input('id');
        $question = Question::find($id);
        //Warning: Do not change topic id
        $question->content = $request->input('content');
        $question->type = $request->input('type');
        $question->status = $request->input('status');
        if($question->save()){
            $answer = Answer::where('question_id', $id)->first();
            if($request->input('type') == 'MULTIPLE_CHOICE' || $request->input('type') == 'FORM'){
                $answer->answer = json_encode($request->input('answer'));
            } else {
                $answer->answer = $request->input('answer');
            }
            if($request->input('option_answer') !== null) {
                $answer->option_answer = json_encode($request->input('option_answer'));
            }
            if($answer->save()){
                if($question->status == StatusEnum::ACTIVE){
                    $status = '<span class="badge badge-success">Mở</span>';
                } else {
                    $status = '<span class="badge badge-danger">Đóng</span>';
                }
                return response()->json([
                    'code' => 1,
                    'content' => $request->input('content'),
                    'status' => $status,
                    'type' => $request->input('type')
                ]);
            } else {
                return response()->json(['code' => 0]);
            }
        } else {
            return response()->json(['code' => 0]);
        }
    }
    public function delete(Request $request){
        $id = $request->input('id');
        $question = Question::find($id);
        $answer = Answer::where('question_id', $id)->first();
        if($question->delete() && $answer->delete()){
            $topic = Topic::find($question->topic_id);
            $topic->num_question -= 1;
            $topic->save();
            return response()->json(['code' => 1, 'msg' => 'Success']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Error']);
        }
    }

    public function getQuestion($id){
        $question = Question::where('id',$id)->first();
        $answer = Answer::where('question_id',$question->id)->first();
        return response()->json([
            'question' =>$question,
            'answer' => $answer
        ]);
    }

}
