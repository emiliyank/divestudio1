<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CmMessage;

class CmMessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     $received_messages = CmMessage::with('createdBy')->where('to_user_id', \Auth::id())
    //         ->orderBy('created_at', 'desc')->get();
    //     $sent_messages = CmMessage::with('toUser')->where('created_by', \Auth::id())
    //         ->orderBy('created_at', 'desc')->get();

    //     return view('messages.user_messages', [
    //         'received_messages' => $received_messages,
    //         'sent_messages' => $sent_messages,
    //         ]);
    // }

    public function index()
    {
        $user_massaged = CmMessage::distinct(['created_by', 'to_user_id'])
            ->with(['createdBy', 'toUser', 'createdBy.userType', 'toUser.userType'])
            ->where('to_user_id', \Auth::id())
            ->orWhere('created_by', \Auth::id())
            ->orderBy('created_at')
            ->get();

        $all_user_messages = array();
        foreach ($user_massaged as $cm_message) {
            if($cm_message->created_by == \Auth::id())
            {
                //this is sent msg
                $all_user_messages[$cm_message->to_user_id][] = $cm_message;
            }
            else
            {
                //this is received msg
                $all_user_messages[$cm_message->created_by][] = $cm_message;
            }
        }

        return view('messages.user_messages', [
            'all_user_messages' => $all_user_messages,
            ]);
    }

    public function add_submit(Request $request){
        $this->validate($request, [
            'message' => 'required|max:1000',
            ]);
        
        $message = new CmMessage;
        $message->message = $request->message;
        $message->to_user_id = $request->to_user_id;
        $message->created_by = \Auth::id();
        $message->save();
   
        \Session::flash('message_sent', trans('messages.flash_msg_sent'));
        return redirect()->back();
    }
}
