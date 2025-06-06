<?php

declare(strict_types=1);

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class UserServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'User';
    }

    public function boot(): void
    {
       $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'users');

        $this->registerTranslations();
        //$this->registerConfig();
        $this->registerMigrations();
    }

    public function register(): void
    {
        $this->registerRoutes();
    }

    public function mapRoutes(): void
    {
        Route::prefix('api/users')
            ->middleware('api')
            ->group($this->getModulePath() . '/Resources/routes/api.php');

        Route::prefix('dashboard/users')
            ->middleware('web')
            ->group($this->getModulePath() . '/Resources/routes/web.php');
    }
}
