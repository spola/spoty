<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Retro compatibility
        Schema::defaultStringLength(191);

        $this->app->bind(
            'App\Repositories\IActivityRepository',
            'App\Repositories\ActivityRepository'
        );
        $this->app->bind(
            'App\Services\IStudentService',
            'App\Services\StudentService'
        );
        $this->app->bind(
            'App\Services\IParentService',
            'App\Services\ParentService'
        );
        $this->app->bind(
            'App\Services\ITeacherService',
            'App\Services\TeacherService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
