<?php

declare(strict_types=1);

namespace Modules\DailyReport\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class DailyReportServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'DailyReport';
    }

    public function boot(): void
    {
                $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'daily-reports');

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
        Route::prefix('api/v1/daily_reports')
            ->middleware('api')
            ->group($this->getModulePath() . '/Resources/routes/api.php');

        Route::prefix('dashboard/daily_reports')
            ->middleware('web')
            ->group($this->getModulePath() . '/Resources/routes/web.php');


        }
}
