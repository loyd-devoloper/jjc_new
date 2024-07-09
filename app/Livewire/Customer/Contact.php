<?php

namespace App\Livewire\Customer;

use App\Models\Cart;
use Livewire\Component;
use App\Mail\ContactEmail;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;

class Contact extends Component
{
    public $name;
    public $email;
    public $message;
    public function sendContact()
    {
        $data = [
            'message'=>$this->message,
            'name'=>$this->name,
            'email'=>$this->email,
        ];
        Mail::to('jjcgeneralstore@gmail.com')->send(new ContactEmail($data));
        Notification::make()
        ->title('Submited successfully')
        ->success()
        ->send();
        $this->message = '';
        $this->name = '';
        $this->email = '';
    }
    #[Title('Contact Us')]
    public function render()
    {
        $cart_count = Cart::where('customer_id',Auth::guard('customer')->id())->count();
        return view('livewire.customer.contact',compact('cart_count'));
    }
}
