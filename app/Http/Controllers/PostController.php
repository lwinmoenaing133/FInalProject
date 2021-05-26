<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //delete
    function deletePost($id){
        $delete_post=Post::find($id);
        $delete_post->delete();
        return redirect()->route("home")->with("message","Deleted");
    }

    //update
    function updatePost($id){
        // get input data in editPost blade
        $title=request("title");
        $image=request("image");
        $content=request("content");
        // update in database 
        //require update id
        $update_data=Post::find($id);
        $update_data->title=$title;
        $update_data->content=$content;
        if($image){
        $imageName=uniqid()."_".$image->getClientOriginalName();
        $image->move(public_path("image/posts/"),$imageName);
        $update_data->image=$imageName;
        }
        $update_data->update();
        return back()->with("message","Updated Post");
    }

    //create_post
    function create_post(){
        $validation=request()->validate([
            "title"=>"required",
            "image"=>"required",
            "content"=>"required"
        ]);
        if($validation){
            $title=request('title');
            $image=request('image'); //file
            $content=request("content");

            //save to db
            $post=new Post();
            $post->user_id=auth()->user()->id;
            $post->title=$title;

            $imageName=uniqid()."_".$image->getClientOriginalName();
            $image->move(public_path("image/posts/"),$imageName);
            $post->image=$imageName;
            $post->content=$content;
            $post->save();
            return redirect()->route("home")->with("message","added post");
        }else{
            return back()->withErrors($validation);
        }
    }
}
