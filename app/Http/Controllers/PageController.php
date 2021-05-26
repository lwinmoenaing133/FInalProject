<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;

class PageController extends Controller
{
    function index(){
        $posts=Post::latest()->paginate(9);
        return view('Index',["posts"=>$posts]);
    }
    //database
    //one to one==>belongsTo()
    //one to many==> hasMany()
    //many to many

    function createPost(){
        return view("user.Create");
    }

    function showPostById($id){
        $post=Post::find($id);
       return view("user.showPost",["post"=>$post]);
    }

    function editPost($id){
        $updateData=Post::find($id);
        return view("user.editPost",["updateData"=>$updateData]);
    }

    function userProfile(){
        return view("user.UserProfile");
    }

    function contactUs(){
        return view("user.ContactUs");
    }
    
}
