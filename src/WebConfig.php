<?php

namespace Tutu\WebConfig;

use Encore\Admin\Admin;
use Encore\Admin\Extension;

class WebConfig extends Extension
{
    /**
     * Load configure into laravel from database.
     *
     * @return void
     */
    public static function load()
    {

    }

    /**
     * Bootstrap this package.
     *
     * @return void
     */
    public static function boot()
    {
        static::registerRoutes();
    }

    /**
     * Register routes for laravel-admin.
     *
     * @return void
     */
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            /* @var \Illuminate\Routing\Router $router */
            $router->resource(
                config('admin.extensions.web_config.name', 'web_config'),
                config('admin.extensions.web_config.controller', 'Tutu\WebConfig\WebConfigController')
            );
        });
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        //创建菜单
        parent::createMenu('WebConfig', 'web_config', 'fa-toggle-on');
        //创建权限
        parent::createPermission('Admin Web Config', 'ext.web_config', 'web_config*');
    }
}
