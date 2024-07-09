<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class Profile extends Component
{
    #[Validate('required')]
    public $fullname;
    #[Validate('required|email')]
    public $email;
    #[Validate('required')]
    public $contact;
    #[Validate('required')]
    public $address;

    public $password;

    public function mount()
    {
        $this->fullname = Auth::guard('customer')->user()->fullname;
        $this->email = Auth::guard('customer')->user()->email;
        $this->contact = Auth::guard('customer')->user()->contact;
        $this->address = Auth::guard('customer')->user()->address;
    }

    public function updatePassword()
    {
        $this->validate([
            'password'=> 'required'
        ]);
        $customer = Customer::where('id',Auth::guard('customer')->id())->update([
            'password' => Hash::make($this->password),

        ]);
        $this->password = '';
        Notification::make()
        ->title('Password Updated successfully')
        ->success()
        ->send();
    }
    public function updateInfo()
    {
        $this->validate();
        $customer = Customer::where('id',Auth::guard('customer')->id())->update([
            'fullname' => $this->fullname,
            'email' => $this->email,
            'contact' => $this->contact,
            'address' =>$this->address,
        ]);
               Notification::make()
        ->title('Updated successfully')
        ->success()
        ->send();
    }
    public function render()
    {
        $cart_count = \App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->count();
        return view('livewire.customer.profile',compact('cart_count'));
    }
}
