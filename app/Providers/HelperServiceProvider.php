<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // app\Helpersフォルダ配下のPHPファイルに追加された関数は、コントローラ、モデル、ビューなどの任意の場所で使用することができるようになる
        $allHelperFiles = glob(app_path('Helpers').'/*.php');
        foreach ($allHelperFiles as $key => $helperFile) {
            require_once $helperFile;
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
