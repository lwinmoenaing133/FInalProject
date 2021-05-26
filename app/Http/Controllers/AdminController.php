<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(){
        return view("admin.index");
    }
    function manage_premium_users(){
        $users=User::all();
        return view("admin.ManagePremiumUsers",['users'=>$users]);
    }
    function contact_messages(){
        $messages=ContactMessage::latest()->get();
        return view("admin.ContactMessages",['messages'=>$messages]); 
    }

    function deleteUser($id){
        //find that delete user from database by id
        $deleteuser=User::find($id);
        //delete that data
        $deleteuser->delete();
        //return back
        return back()->with("message","Deleted User");
    }

    function editUser($id){
        $updateUser=User::find($id);
        return view("admin.editUser",["updateUser"=>$updateUser]);
    }

    function updateUser($id){
        $validation=request()->validate([
            "name"=>"required",
            "email"=>"required",
            "isAdmin"=>"required",
            "isPremium"=>"required"
        ]);
        if($validation){
            //find that data in user table by id
            $updateUser=User::find($id);
            //overwrite that data
            $updateUser->name=request("name");
            $updateUser->email=request("email");
            $updateUser->isAdmin=request("isAdmin");
            $updateUser->isPremium=request("isPremium");
            $updateUser->update();
            //return back
            return back()->with("message","Updated");
        }else{
            return back()->withErrors($validation);
        }
    }
}
