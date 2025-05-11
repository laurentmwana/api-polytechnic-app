<?php

namespace App\Providers;

use App\Models\ActualLevel;
use App\Models\AcademicFees;
use App\Models\LaboratoryFees;
use App\Observers\ActualLevelObserver;
use App\Observers\AcademicFeesObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\LaboratoryFeesObserver;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ActualLevel::observe(new ActualLevelObserver());
        AcademicFees::observe(new AcademicFeesObserver());
        LaboratoryFees::observe(new LaboratoryFeesObserver());
    }
}
