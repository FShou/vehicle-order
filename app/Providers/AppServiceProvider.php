<?php

namespace App\Providers;

use App\Listeners\OrderRejectedListener;
use App\Policies\ProcessApprovalFlowPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use RingleSoft\LaravelProcessApproval\Models\ProcessApprovalFlow;
use RingleSoft\LaravelProcessApproval\Events\ProcessRejectedEvent;
class AppServiceProvider extends ServiceProvider
{

    protected $listen = [
        ProcessRejectedEvent::class => [
            OrderRejectedListener::class
        ]
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Model::unguard();
        Gate::policy(ProcessApprovalFlow::class, ProcessApprovalFlowPolicy::class);
    }
}
