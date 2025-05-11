<?php

declare(strict_types=1);

namespace Modules\TherapySession\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class TherapySessionServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'TherapySession';
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'therapysession');
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
            Route::prefix('dashboard/therapy_sessions')
            ->middleware('web')
            ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}
