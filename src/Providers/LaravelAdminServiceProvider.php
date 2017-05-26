<?php

namespace LaravelAdmin\Providers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use LaravelAdmin\Services\OptionRepository;

class LaravelAdminServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @param  ResponseFactory  $factory
     * @return void
     */
    public function boot()
    {
        //需要生成的迁徙文件
        $this->publishes([
            __DIR__.'/../Publishes/database/migrations' => database_path('migrations')
        ], 'migrations');
        //需要生成的数据填充
        $this->publishes([
            __DIR__.'/../Publishes/database/seeds' => database_path('seeds')
        ], 'seeds');
        //时间语言设置
        \Carbon\Carbon::setLocale(array_get(explode('-',config('app.locale')),0));
        Route::pattern('id', '[0-9]+'); //全局路由设置



    }



    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //系统配置
        $this->app->singleton('option', OptionRepository::class);
    }
}
