<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

use Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('formatDate', function ($date) {

            return "<?php echo  isset($date)?($date)->format('d-m-Y'):'' ?>";
        });

        Blade::component('components.user_menu', 'user_menu');
    }
}
