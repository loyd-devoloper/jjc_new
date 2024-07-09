<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Navigation\MenuItem;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationGroup;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                // ...
                'logouts' => MenuItem::make()
                ->label('Change Password')->icon('heroicon-o-key')->url(fn() => route('filament.admin.pages.settings')),

            ]);
        });
    }
}
