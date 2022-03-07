<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function createResult(Request $request){
        $num_correct = 0;
        $num_incorrect = 0;
        $result = [];
        $data = $request->all();
        for($i = 1; $i <= $data['num_question']; $i++){
            if($data['question_type_'.$i] == 'FORM'){
                $isCorrect = false;
                if($data['answer_'.$data['question_id_'.$i]] != ''){
                    $q = Answer::where('question_id',$data['question_id_'.$i])->first();
                    if($q->answer == $data['answer_'.$data['question_id_'.$i]]){
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
                    'answer'=> $answer,
                    'isCorrect' => $isCorrect
                ]);

                //echo 'MULTIPLE_CHOICE';
            }
        }
        $result_user = new Result();
        $result_user->topic_id = $data['topic_id'];
        $result_user->user_id = $data['user_id'];
        $result_user->num_correct = $num_correct;
        $result_user->num_incorrect = $num_incorrect;
        $result_user->result = json_encode($result);
        $result_user->save();
        echo(json_encode($result));
//        for($i=1;$i<=$request->index;$i++){
//
//            if(isset($data['question'.$i])){
//                $q=Answer::where('id',$data['question'.$i])->get()->first();
//
//                if($q->ans==$data['ans'.$i]){
//                    $result[$data['question'.$i]]='YES';
//                    $yes_ans++;
//                }else{
//                    $result[$data['question'.$i]]='NO';
//                    $no_ans++;
//                }
//            }
//        }
    }
}
