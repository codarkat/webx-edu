<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function store(Request $request){
        if(Subscribe::where('user_id', $request->input('user_id'))
            ->where('topic_id', $request->input('topic_id'))->get()->count() > 0){
            return response()->json(['code' => 2]);
        } else {
            $subscribe = new Subscribe();
            $subscribe->user_id = $request->input('user_id');
            $subscribe->topic_id = $request->input('topic_id');
            if($subscribe->save()){
                return response()->json(['code' => 1]);
            } else {
                return response()->json(['code' => 0]);
            }
        }
    }

    public function delete(Request $request){
        if(Subscribe::where('user_id', $request->input('user_id'))
                ->where('topic_id', $request->input('topic_id'))->first()->delete()){
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 0]);
        }
    }
}
