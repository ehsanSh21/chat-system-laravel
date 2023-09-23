<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //33
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

//        Gate::before(function (){
//
//        });

        Gate::define('update-post',function ($user){
            if ($user->id==2){
               return true;
            }else{
                return false;
            }
        });
    }
}
