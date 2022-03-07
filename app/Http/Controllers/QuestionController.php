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
    public function createQuestion(Request $request){
        $validator = Validator::make($request->all(),[
            'content'=>'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $question = new Question();
            $question->content = $request->input('content');
            $question->topic_id = 1;
            $question->type = $request->input('type');
            $question->status = 'ACTIVE';
            $question->save();

            switch ($request->input('type')){
                case "CHOICE":  {
                    $answer_choice = new Answer();
                    $answer_choice->answer = $request->input('answer');
                    $answer_choice->question_id = $question->id;
                    $answer_choice->option_answer = json_encode($request->input('option_answer'));
                    $answer_choice->save();
                    return response()->json(['code'=> 1]);
                }
                case "FORM":    {
                    $answer = new Answer();
                    $answer->question_id = $question->id;
                    $answer->answer = $request->input('answer');
                    $answer->save();
                    return response()->json(['code'=> 1]);
                }
                case "MULTIPLE_CHOICE":{
                    $answer_multiple_choice = new Answer();
                    $answer_multiple_choice->answer = json_encode($request->input('answer'));
                    $answer_multiple_choice->question_id = $question->id;
                    $answer_multiple_choice->option_answer = json_encode($request->input('option_answer'));
                    $answer_multiple_choice->save();
                    return response()->json(['code'=> 1]);
                }
            }

        }
    }

    public function getQuestions(){
        $topic = Topic::find(1);
        $questions = Question::where('topic_id',$topic->id)->get();
        return view('main.index', [
            'questions' => $questions,
            'topic' => $topic,
        ]);
    }
    public function adminGetQuestions(){
        $topic = Topic::find(1);
        $questions = Question::where('topic_id',$topic->id)->get();
        return view('admin.questions', [
            'questions' => $questions,
            'topic' => $topic,
        ]);
    }

    public function ajaxGetListQuestions(Request $request){
        if ($request->ajax()) {
            $questions = Question::where('topic_id',1)->get();
            return Datatables::of($questions)
                ->addIndexColumn()
                ->addColumn('action', function($question){
                    return '
                            <a type="button" class="btn btn-primary ajax-edit-question" data-bs-toggle="modal" data-bs-target="#modal-edit-question" data-id="'.$question->id.'"><i class="material-icons">add</i>Sửa</a>
                            <a type="button" class="btn btn-danger ajax-delete-question" data-id="'.$question->id.'"><i class="material-icons">delete_outline</i>Xóa</a>
                    ';
                })
                ->editColumn('status', function ($question) {
                    if($question->status == StatusEnum::ACTIVE){
                        return '<span class="badge badge-success">Mở</span>';
                    } else {
                        return '<span class="badge badge-danger">Đóng</span>';
                    }
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
    }

    public function ajaxGetAQuestion($id){
        $question = Question::where('id',$id)->first();
        $answer = Answer::where('question_id',$question->id)->first();
        return response()->json([
            'question' =>$question,
            'answer' => $answer
        ]);
    }
    public function deleteQuestion(Request $request){
        $id = $request->input('id');
        $question = Question::find($id);
        $answer = Answer::where('question_id', $id)->first();
        if($question->delete() && $answer->delete()){
            return response()->json(['code'=>1, 'msg' => 'Success']);
        } else {
            return response()->json(['code'=>0, 'msg' => 'Error']);
        }
    }
}
