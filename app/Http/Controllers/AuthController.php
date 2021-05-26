<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    function login(){
        return view("auth.Login");
    }
    function post_login(){
        $validation=request()->validate([
            "email"=>"required",
            "password"=>"required"
        ]);
        //if validation success
        if($validation){
            //if auth is success or not
            $auth=Auth::attempt(["email"=>$validation['email'],"password"=>$validation['password']]);
            if($auth){
                //go to home page
            return redirect()->route("home");
            }else{
                return back()->with("error","Authentication Failed. Try again.");
            }
            //else go to back with auth fail error


            
        }
        //else go back to login page with errors
        else{
            return back()->withErrors($validation);
        }
    }




    //register
    function register(){
        return view("auth.Register");
    }
    function post_register(){
        $validation=request()->validate([
            "username"=>"required",
            "email"=>"required",
            "password"=>"required || min:8 || confirmed",
            "image"=>"required"
        ]);
        if($validation){
            //database save
            $image=request("image"); //move image file to public path
            $image_name=uniqid()."_".$image->getClientoriginalName(); //save image name in database //aasdfd_bg.jpg   aeeerds_bg.jpg
            $image->move(public_path('/image/profiles/'),$image_name);

            $password=$validation['password'];
            $user=new User();
            $user->name=$validation['username'];
            $user->email=$validation['email'];
            $user->password=Hash::make($password);
            $user->image=$image_name;
            //take 1 or 2 second to save data in database
            $user->save();

            if(Auth::attempt(["email"=>$validation['email'],"password"=>$validation['password']])){
                return redirect()->route("home");
            }
            
            
        }else{
            return back()->withErrors($validation);
        } 
    }

    function post_userProfile(){
        $name=request("name");
        $email=request("email");
        $image=request("image");
        $old_password=request("old_password");
        $new_password=request("new_password");

        //if user dont select image and dont change password, add name and email
        $id=auth()->user()->id;
        $current_user=User::find($id);
        $current_user->name=$name;
        $current_user->email=$email;

        if($image){
            //move file to public path
            $image_Name=uniqid()."_". $image->getClientoriginalName();
            $image->move(public_path('image/profiles/'),$image_Name); //save imageName to current_user id
            $current_user->image=$image_Name;
            $current_user->update();
            return back()->with("success","Image is Updated.");  
        }

        if($old_password && $new_password){
            //check user input old psw is same as current user pw in db
            if(Hash::check($old_password,$current_user->password)){
                //if same  let user to change psw
                $current_user->password=Hash::make($new_password);
                $current_user->update();
                return back()->with("success","Password is Updated.");
            }
            else{
                return back()->with("error","Password is not same.");
            }
        }
        $current_user->update();
            return back();
    }

    //logout
    function logout(){
        Auth::logout();
        return redirect()->route("login");
    }
}
