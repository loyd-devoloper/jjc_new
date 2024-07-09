<?php

namespace App\Livewire\Auth;

use App\Models\Otp;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Filament\Notifications\Notification;

class Register extends Component
{
    #[Validate('required')]
    public $fullname;
    #[Validate('required|email')]
    public $email;
    #[Validate('required|unique:customers,contact')]
    public $contact;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $password;
    public function registerCustomer()
    {


        $this->validate();

        $customer = Customer::create([
            'fullname' => $this->fullname,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'contact' => $this->contact,
            'address' =>$this->address,
            'contact_verify'=>false
        ]);
        $randomNumber =rand(10000, 99999);
        $otp = Otp::create([
            'customer_id'=>$customer->id,
            'otp'=>$randomNumber,
            'status'=>false
        ]);
        $response = Http::post('https://semaphore.co/api/v4/messages',[
            'apikey' => '7338bafb9fef713705ea897a234722cf', //Your API KEY
            'number' => $this->contact,
            'message' => 'OTP:'.$randomNumber,
            'sendername' => 'SEMAPHORE'
        ]);

        return redirect()->route('otp',['id'=>Crypt::encryptString($otp->id)]);
        // Notification::make()
        // ->title('Saved successfully')
        // ->success()
        // ->send();
    }
    public function render()
    {
        $cart_count = 0;
        return view('livewire.auth.register',compact('cart_count'));
    }
}
