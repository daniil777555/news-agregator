<?php

namespace App\Providers;

use App\Services\Parser;
use App\Services\InteractionWithImage;
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
        $this->app->bind(Parser::class, function() {
			return new Parser();
		});

        $this->app->bind(InteractionWithImage::class, function() {
			return new InteractionWithImage();
		});
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
