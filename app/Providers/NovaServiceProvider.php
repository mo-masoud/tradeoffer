<?php

namespace App\Providers;

use App\Nova\Branch;
use App\Nova\Category;
use App\Nova\Dashboards\Main;
use App\Nova\Product;
use App\Nova\Role;
use App\Nova\Store;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::withBreadcrumbs();

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('home'),

                MenuSection::make('Users & Roles', [
                    MenuItem::resource(Role::class),
                    MenuItem::resource(User::class),
                ])->icon('user-group')->collapsable(),

                MenuSection::make('Stores & Branches', [
                    MenuItem::resource(Store::class),
                    MenuItem::resource(Branch::class),
                ])->icon('library')->collapsable(),

                MenuSection::make('Market', [
                    MenuItem::resource(Category::class),
                    MenuItem::resource(Product::class),
                ])->icon('shopping-bag')->collapsable(),
            ];
        });
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
        ];
    }

//    protected function authorization()
//    {
////        Nova::auth(function ($request) {
////            return Gate::check('viewNova', [Nova::user($request)]);
////        });
//    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->role, [
                'admin',
                'super-admin'
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main,
        ];
    }
}
