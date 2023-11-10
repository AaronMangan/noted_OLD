<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Page;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Check a user may edit a page. Only users that own the page may edit it.
        Gate::define('manage-page', function (User $user, Page $page) {
            return ((int) $user->id == (int) $page->user_id) ? true : false;
        });

        // Check a user may view a page
        Gate::define('view-page', function (User $user, Page $page) {
            return ($user->id === $page->user_id || (isset($page->shared_with_users) && in_array($user->id, $page->shared_with_users ?? [])));
        });
    }
}
