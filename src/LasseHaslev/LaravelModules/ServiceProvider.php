<?php

namespace LasseHaslev\LaravelModules;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // Publish config
        $this->publishes([
            __DIR__.'../../config/laravelmodules.php' => config_path('laravelmodules.php'),
        ]);

        // Get module path
        $modulesPath = config('laravelmodules.paths.main');
        if (is_dir($modulesPath)) {

            $modules = $this->files->directories($modulesPath);

            // Setup each module
            foreach($modules as $module) {
                // Setup Config
                $this->setupConfig($module);
                $this->setupRoutes($module);
                $this->setupViews($module);
            }

        }
    }

    /**
     * Set up all the config files to the current files
     *
     * @return void
     */
    protected function setupConfig($module)
    {
        $moduleName = $this->files->name($module);

        $config = $module . config('laravelmodules.paths.relative.config');
        if ($this->files->isDirectory($config)) {

            $files = $this->files->files($config);

            $baseConfigName = config('laravelmodules.keys.basekey');
            foreach ($files as $file) {
                $fileName = $this->files->name($file);

                $fullReference = $baseConfigName . strtolower($moduleName) . '.' . $fileName;
                if ($this->files->exists($config)) $this->mergeConfigFrom(
                    $file, $fullReference
                );
            }

        }
    }

    /**
     * Register the routes for this module
     *
     * @return void
     */
    protected function setupRoutes($module)
    {
        $routes = $module . config('laravelmodules.paths.relative.routes');
        if ($this->files->exists($routes)) include $routes;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    protected function setupViews($module)
    {
        $moduleName = $this->files->name($module);

        $views = $module . config('laravelmodules.paths.relative.views');
        $fullReference = config('laravelmodules.keys.basekey') . strtolower($moduleName);
        if ($this->files->isDirectory($views)) $this->loadViewsFrom($views, $fullReference);

    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->files = new Filesystem;
    }
}

