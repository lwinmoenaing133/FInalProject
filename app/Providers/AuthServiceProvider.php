<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\FuncCall;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define("admin",function(User $user){
            //$user==auth()->user
            return $user->isAdmin=="1";
        });

        Gate::define("PremiumAdminPostowner",function(User $user,$id){
            $post_data=Post::find($id);
            $postOwnerId=$post_data->user_id;

            return $user->isPremium=="1" || $user->isAdmin=="1" || $user->id==$postOwnerId;
        });

        Paginator::useBootstrap();
    }
}
