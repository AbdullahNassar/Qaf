<?php

namespace App\Providers;

use App\Category;
use App\Meta;
use App\Notification;
use Illuminate\Support\ServiceProvider;
use App\Settings;
use App\ContactUs;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
        $settings = Settings::first();
        $contacts = ContactUs::get();
        $allCategories = Category::orderby('id' ,'ASC')->get();
        $metas = Meta::get();
        $notifications = Notification::Orderby('id' ,'ASC')->get();

        view()->share([
            'settings' => $settings,
            'contacts' => $contacts,
            'allCategories' => $allCategories,
            'metas' => $metas,
            'notifications' => $notifications,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
