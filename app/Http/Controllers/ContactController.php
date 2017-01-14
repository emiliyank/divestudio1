<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\ClFeedbackTopic;
use App\CmFeedback;
use App\ClStatuse;

class ContactController extends Controller{

    public function index(){
        $user=false;
        if (\Auth::id()){
            $user = User::where('id', \Auth::id())->first();
        }
        return view('contacts.contact', [
            'cl_feedback_topics' => ClFeedbackTopic::get(),
            'user' => $user,
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
        $feedback->cl_status_id = 'Отворено';
        if (\Auth::id()){
            $feedback->created_by = \Auth::id();
        }
        $feedback->save();
        
        return redirect('/contact/ok');
    }
    
    public function contacts_list(){
        $user=User::where('id', \Auth::id())->first();
        if ($user->user_type == 999){
            $cm_feedbacks = CmFeedback::get();
            return view ('contacts.contacts_list', [
                'cm_feedbacks' => $cm_feedbacks,
                'cl_feedback_topics' => ClFeedbackTopic::get(),
                'cl_statuses' => ClStatuse::get(),
            ]);
        }
    }
    
    public function contacts_status(Request $request){
        $user=User::where('id', \Auth::id())->first();
        if ($user->user_type == 999){
            $cm_feedback = CmFeedback::where('id', $request->contact_id)->first();
            $cm_feedback->cl_status_id = $request->cl_status_id;
            $cm_feedback->save();
        }
        
        return redirect('/contacts-list');
    }
    
}

