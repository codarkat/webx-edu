<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use App\Models\Topic;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm() //Go web.php then you will find this route
    {
        return view('admin.login');
    }

    public function login(Request $request) //Go web.php then you will find this route
    {
        $this->validate($request,[
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30',
        ]);


        $creds = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('fail', __('notifications.ERROR.Check your email and password'));
        }
    }

    public function logout(Request $request)
    {
        $this->guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }


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
    public function listResults(){
        return view('admin.list-results');
    }

    public function result($user_id, $topic_id){
        $result = Result::where('topic_id',$topic_id)->where('user_id',$user_id)->first();
        $topic = Topic::find($topic_id);
        $questions = Question::where('topic_id',$topic->id)->get();
        return view('admin.result', [
            'questions' => $questions,
            'topic' => $topic,
            'result' => $result
        ]);
    }


}
