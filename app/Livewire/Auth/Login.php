<?php

namespace App\Livewire\Auth;

use App\Models\Cart;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class Login extends Component
{

    #[Validate('required')]
    public $contact;
    #[Validate('required')]
    public $password;

    public function loginCustomer()
    {
        $this->validate();

        if (Auth::guard('customer')->attempt(['contact' => $this->contact, 'password' => $this->password])) {
            if (Auth::guard('customer')->user()->contact_verify == '0') {
                Notification::make()
                    ->title('Please verify your account number before logging in.')
                    ->danger()
                    ->send();
            } else {
                Notification::make()
                    ->title('Login Successfully!')
                    ->success()
                    ->send();
                return redirect()->route('homepage');
            }
        }else{
            Notification::make()
            ->title('Wrong Credentials')
            ->danger()
            ->send();
        }

    }
    #[Title('Login')]
    public function render()
    {
        $cart_count = 0;
        return view('livewire.auth.login', compact('cart_count'));
    }
}
