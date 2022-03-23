<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Result;
use App\Models\Subscribe;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TopicController extends Controller
{
    public function store(Request $request){
        $topic = new Topic();
        $topic->name = $request->input('name');
        $topic->description = $request->input('description');
        $topic->deadline = $request->input('deadline');
        $topic->duration = $request->input('duration');
        $topic->num_question = 0;
        $topic->status = 'ACTIVE';
        if($topic->save()){
            $data = $request->all();
            $data['num_question'] = 0;
            $data['status'] = 'INACTIVE';
            $data['id'] = $topic->id;
            return response()->json([
                'code' => 1,
                'data' => $data
            ]);
        } else {
            return response()->json(['code' => 0]);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        $topic = Topic::find($id);
        $topic->name = $request->input('name');
        $topic->description = $request->input('description');
        $topic->deadline = $request->input('deadline');
        $topic->duration = $request->input('duration');
        $topic->status = $request->input('status');
        if($topic->save()){
            $data = Topic::find($id);
            return response()->json([
                'code' => 1,
                'data' => $data
            ]);
        } else {
            return response()->json(['code' => 0]);
        }
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $topic = Topic::find($id);
        $questions = Question::where('topic_id', $topic->id)->get();
        $success = true;
        foreach ($questions as $question){
            $answer = Answer::where('question_id', $question->id)->first();
            if(!($question->delete() && $answer->delete())){
                $success = false;
            }
        }
        if($success && $topic->delete()){
            return response()->json([
                'code' => 1,
                'count' => Topic::all()->count(),
            ]);
        } else {
            return response()->json(['code' => 0]);
        }
    }

    public function getTopic($id){
        $topic = Topic::where('id',$id)->first();
        return response()->json([
            'topic' =>$topic
        ]);
    }

    public function getActiveTopics(){
        $topics = Topic::where('status', StatusEnum::ACTIVE)
            ->where('num_question', '>', 0)->get();
        return response()->json([
            'topics' =>$topics
        ]);
    }



    public function getTopicDetails(Request $request, $id){
        if ($request->ajax()) {
            $questions = Question::where('topic_id',$id)->get();
            return Datatables::of($questions)
                ->addIndexColumn()
                ->addColumn('action', function($question){
                    return '
                            <a type="button" class="btn btn-warning ajax-edit-question" data-bs-toggle="modal" data-bs-target="#modal-edit-question" data-id="'.$question->id.'"><i class="material-icons">edit</i>Sửa</a>
                            <a type="button" class="btn btn-danger ajax-delete-question" data-id="'.$question->id.'"><i class="material-icons">delete_outline</i>Xóa</a>
                    ';
                })
                ->editColumn('content', function ($question) {
                    return $question->content;
                })
                ->editColumn('status', function ($question) {
                    if($question->status == StatusEnum::ACTIVE){
                        return '<span class="badge badge-success">Mở</span>';
                    } else {
                        return '<span class="badge badge-danger">Đóng</span>';
                    }
                })
                ->rawColumns(['content', 'status','action'])
                ->make(true);
        }
    }
}
