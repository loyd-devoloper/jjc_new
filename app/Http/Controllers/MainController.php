<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class MainController extends Controller
{
    public function logoutCustomer()
    {
        Auth::guard('customer')->logout();
        Notification::make()
        ->title('Logout Successfully!')
        ->success()
        ->send();
        return redirect()->route('login');

    }
}
