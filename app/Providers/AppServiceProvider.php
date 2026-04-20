<?php

namespace App\Providers;

use App\Services\Auth\AesDecryptionService;
use App\Services\Auth\TwoFactorService;
use App\Services\Contracts\AesDecryptionServiceInterface;
use App\Services\Contracts\TwoFactorServiceInterface;
use Illuminate\Support\ServiceProvider;
use PragmaRX\Google2FA\Google2FA;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AesDecryptionServiceInterface::class, AesDecryptionService::class);

        $this->app->bind(TwoFactorServiceInterface::class, function () {
            return new TwoFactorService(new Google2FA());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
