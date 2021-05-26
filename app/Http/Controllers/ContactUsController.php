<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    function post_contact_message(){
        //validate our data
        $validation=request()->validate([
            "username"=>"required",
            "email"=>"required",
            "message"=>"required"
        ]);
        if($validation){
            // get input data from input field
            $username=request('username');
            $email=request('email');
            $text=request('message');
            // save data in database
            $message=new ContactMessage();
            $message->username=$username;
            $message->email=$email;
            $message->messages=$text;
            $message->save();
        }else{
            return back()->withErrors($validation);
        }
        return back()->with("message","Message is sent to admin.");
    }

    function editMessage($id){
        $updateData=ContactMessage::find($id);
        return view("admin.editMessage",["updateData"=>$updateData]);
    }

    function deleteMessage($id){
        // find that delete data from database by id
        $deleteData=ContactMessage::find($id);
        //delete that data 
        $deleteData->delete();
        return back()->with("message","message is deleted.");
    }

    function updateMessage($id){
        //validation
        $validation=request()->validate([
            "username"=>"required",
            "email"=>"required",
            "message"=>"required"
        ]);
        if($validation){
            //find that update data in database by id
            $updateData=ContactMessage::find($id);
            //overwrite that data from edit page
            $updateData->username=request('username');
            $updateData->email=request("email");
            $updateData->messages=request("message");
            //update that data
            $updateData->update();
            return back()->with("message","updated");
        }else{
            return back()->withErrors($validation);
        }
        
    }
}
