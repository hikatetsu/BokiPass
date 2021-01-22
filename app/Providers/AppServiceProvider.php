<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Bootstrapを使うため
        Paginator::useBootstrap();

        // 実行されているクエリが分かるように（ログファイルはstorage/logs/larevel.log）n+1問題確認用
        // \DB::listen(function ($query) {
        //     $sql = $query->sql;
        //     for ($i = 0; $i < count($query->bindings); $i++) {
        //         $sql = preg_replace("/\?/", $query->bindings[$i], $sql, 1);
        //     }
        //     \Log::info($sql);
        // });
    }
}
