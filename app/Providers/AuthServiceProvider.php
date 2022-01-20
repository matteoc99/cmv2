<?php

namespace App\Providers;

use App\Models\Condominium;
use App\Models\Family;
use App\Models\Ticket;
use App\Policies\CondominiumPolicy;
use App\Policies\FamilyPolicy;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Condominium::class => CondominiumPolicy::class,
        Family::class => FamilyPolicy::class,
        Ticket::class => TicketPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
