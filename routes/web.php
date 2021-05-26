<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;



Route::middleware("auth")->group(function(){
    //home
    Route::get('/',[PageController::class,"index"])->name("home");
    //user
    Route::get('/user/createPost',[PageController::class,"createPost"])->name("createPost");
    Route::get('/posts/{id}',[PageController::class,"showPostById"])->name("showPostById");
    Route::get('/posts/update/{id}',[PageController::class,"editPost"])->name("editPost");
    Route::get('/user/userProfile',[PageController::class,"userProfile"])->name("userProfile");
    Route::get('/user/contactUs',[PageController::class,"contactUs"])->name("contactUs");

    //contactus
    Route::post('/user/contactUs',[ContactUsController::class,'post_contact_message'])->name("post_contact_message");

    //posts
    Route::get('/posts/delete/{id}',[PostController::class,"deletePost"])->name("deletePost")->middleware("premiumUser");
    Route::post('/posts/update/{id}',[PostController::class,"updatePost"])->name("updatePost")->middleware("premiumUser");
    Route::post('/user/createPost',[PostController::class,"create_post"])->name("create_post");

    //auth
    Route::post('/user/userProfile',[AuthController::class,"post_userProfile"])->name("post_userProfile");
    Route::get("/logout",[AuthController::class,"logout"])->name("logout");
    
    //admin
Route::middleware("admin")->group(function(){
    Route::get('/admin/user/contact_messages/edit/{id}',[ContactUsController::class,'editMessage'])->name("editMessage");
    Route::post('/admin/user/contact_messages/update/{id}',[ContactUsController::class,'updateMessage'])->name("updateMessage");
    Route::get('/admin/contact_messages/delete/{id}',[ContactUsController::class,"deleteMessage"])->name("deleteMessage");
    Route::get('/admin/index',[AdminController::class,"index"])->name("admin.home");
    Route::get('/admin/manage_premium_users',[AdminController::class,"manage_premium_users"])->name("manage_premium_users");
    Route::get('/admin/manage_premium_users/edit/{id}',[AdminController::class,"editUser"])->name("editUser");
    Route::post('/admin/manage_premium_users/update/{id}',[AdminController::class,"updateUser"])->name("updateUser");
    Route::get('/admin/manage_premium_users/delete/{id}',[AdminController::class,"deleteUser"])->name("deleteUser");
    Route::get('/admin/contact_messages',[AdminController::class,"contact_messages"])->name("contact_messages");
    });
    
});




Route::middleware("guest")->group(function(){
//authentication
    Route::get("/login",[AuthController::class,"login"])->name("login");
    Route::post("/login",[AuthController::class,"post_login"])->name("post_login");
    Route::get("/register",[AuthController::class,"register"])->name("register");
    Route::post("/register",[AuthController::class,"post_register"])->name("post_register");
});


