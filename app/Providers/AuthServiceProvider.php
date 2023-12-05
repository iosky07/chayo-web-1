<?php

namespace App\Providers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    public $log;
    protected $policies = [
//         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
//        dd("Im Here");
        $this->log = [
            'user_id' => Auth::id(),
            'access' => 'LOGIN',
            'activity' => 'user Yoski has logged in'
        ];
//
//        dd($this->log);
//        Log::create($this->log);
        $this->registerPolicies();

        //
    }
}
