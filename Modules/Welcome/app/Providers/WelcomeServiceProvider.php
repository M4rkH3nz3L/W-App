<?php

namespace Modules\Welcome\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WelcomeServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Welcome';
    protected string $moduleNameLower = 'welcome';

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom($this->getModulePath('database/migrations'));
        $this->loadRoutesFrom(base_path('Modules/'.$this->moduleName.'/Routes/web.php'));
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register any custom commands.
     */
    protected function registerCommands(): void
    {
        // $this->commands([
        //     \Modules\Welcome\Console\Commands\SomeCommand::class,
        // ]);
    }

    /**
     * Register command schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations for the module.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom($this->getModulePath('Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($this->getModulePath('Resources/lang'));
        }
    }

    /**
     * Register the configuration files.
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            $this->getModulePath('Config/config.php') => config_path($this->moduleNameLower.'.php'),
        ], 'config');

        $this->mergeConfigFrom($this->getModulePath('Config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register the views for the module.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = base_path('Modules/'.$this->moduleName.'/Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.ltrim(config('modules.paths.generator.component-class.path'), config('modules.paths.app_folder', '')));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<string>
     */
    public function provides(): array
    {
        return [];
    }

    /**
     * Get the publishable view paths.
     *
     * @return array<string>
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            $modulePath = $path.'/modules/'.$this->moduleNameLower;
            if (is_dir($modulePath)) {
                $paths[] = $modulePath;
            }
        }

        return $paths;
    }

    /**
     * Get the path for the module.
     *
     * @param string $path
     * @return string
     */
    private function getModulePath(string $path): string
    {
        return base_path('Modules/'.$this->moduleName.'/'.$path);
    }
}
