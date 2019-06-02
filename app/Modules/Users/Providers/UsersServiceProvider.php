<?php

namespace Modules\Users\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    private $namespace = 'Modules\\Users\\Http\\Controllers';

    private $module_path = null;

    private $module_name = 'Users';

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);
        $this->module_path = dirname(__DIR__) . DIRECTORY_SEPARATOR;
    }

    public function boot()
    {
        $this->load_config_files();
        $this->map();
        $this->load_views();
        $this->load_migrations();
    }

    private function load_config_files()
    {
        $config_path = $this->module_path . 'Config' . DIRECTORY_SEPARATOR;
        $files = array_diff(scandir($config_path), ['.', '..']);
        foreach ($files as $file) {
            $key = pathinfo($file, PATHINFO_FILENAME);
            $path = $config_path . $file;
            $this->mergeConfigFrom($path, $key);
        }
    }

    private function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    private function mapApiRoutes()
    {
        Route::prefix('api/' . 'users')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group($this->module_path . 'Routes' . DIRECTORY_SEPARATOR . 'api.php');
    }

    private function mapWebRoutes()
    {
        Route::prefix('users')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group($this->module_path . 'Routes' . DIRECTORY_SEPARATOR . 'web.php');
    }

    private function load_views()
    {
        $this->loadViewsFrom($this->module_path . 'Resources' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'users', 'users');
        $this->loadTranslationsFrom($this->module_path . 'Resources' . DIRECTORY_SEPARATOR . 'Lang', 'users');
    }

    private function load_migrations()
    {
        $this->loadMigrationsFrom($this->module_path . 'Database' . DIRECTORY_SEPARATOR . 'Migrations');
    }

}