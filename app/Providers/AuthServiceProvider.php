<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\api\client\ProfileController;
use App\Models\Category;
use App\Models\role;
use App\Models\Size;
use App\Models\User;
use App\Models\Vouchers;
use App\Policies\AdminPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ClientPolicy;
use App\Policies\RolePolicy;
use App\Policies\SizePolicy;
use App\Policies\UserPolicy;
use App\Policies\VoucherPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => AdminPolicy::class,
        User::class => ClientPolicy::class
    ];

    /**
     * Register any auth / authorization services.
     */
    public function boot(): void
    {
        //
    }

}
