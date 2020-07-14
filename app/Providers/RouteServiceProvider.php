<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        if(!app()->runningInConsole()){
            if(defined("IS_ADMIN")) {
                $this->mapAdminAdminRoutes();
                // $this->mapAdminApiRoutes();
            }elseif(defined("IS_MEMBER")) {
                $this->mapAdminMemberRoutes();
                // $this->mapAdminApiRoutes();
            }
        }
//        $this->mapApiRoutes();
//
//        $this->mapWebRoutes();

        //
    }

    protected function mapAdminAdminRoutes()
    {
        Route::middleware('admin')
            ->namespace($this->namespace."\\Admin")
            ->group(base_path('routes/admin/admin.php'));
    }

    protected function mapAdminMemberRoutes()
    {
        Route::middleware('member')
            ->namespace($this->namespace."\\Member")
            ->group(base_path('routes/member/member.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
//    protected function mapWebRoutes()
//    {
//        Route::middleware('web')
//             ->namespace($this->namespace)
//             ->group(base_path('routes/web.php'));
//    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
//    protected function mapApiRoutes()
//    {
//        Route::prefix('api')
//             ->middleware('api')
//             ->namespace($this->namespace)
//             ->group(base_path('routes/api.php'));
//    }
}
