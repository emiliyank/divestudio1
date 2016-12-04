<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClFeedbackTopic;
use App\CmFeedback;

class ContactController extends Controller{

    public function index(){
        return view('contacts.contact', [
            'cl_feedback_topics' => ClFeedbackTopic::get(),
        ]);
    }
    
    public function add_submit(Request $request){
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|email|max:150',
            'feedback' => 'required|max:2000',
	]);
        
        $feedback = new CmFeedback;
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->phone = $request->phone;
        $feedback->cl_feedback_topic_id = $request->cl_feedback_topic_id;
        $feedback->feedback = $request->feedback;
        $feedback->cl_status_id = 'open';
        if (\Auth::id()){
            $feedback->created_by = \Auth::id();
        }
        $feedback->save();
        
        return redirect('/contact/ok');
    }
    
}

