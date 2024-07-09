<?php

namespace App\Filament\Pages\Auth;

use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Models\Contracts\FilamentUser;
use Filament\Http\Responses\Auth\LoginResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;


class AdminLogin extends \Filament\Pages\Auth\Login
{

    public ?array $data = [];

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    public function authenticate(): ?LoginResponse
    {

        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();
        if (! Auth::guard('web')->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {

            $this->throwFailureValidationException();

        }
        $x = Auth::guard('web')->user();
        Filament::auth()->login($x);
        $user = Filament::auth()->user();

        if (
            ($user instanceof FilamentUser) &&
            (! $user->canAccessPanel(Filament::getCurrentPanel()))
        ) {

            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

}
