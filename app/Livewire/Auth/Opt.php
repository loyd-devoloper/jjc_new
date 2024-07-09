<?php

namespace App\Livewire\Auth;

use App\Models\Otp;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Filament\Notifications\Notification;

class Opt extends Component
{
    #[Validate('required')]
    public $otp1;
    #[Validate('required')]
    public $otp2;
    #[Validate('required')]
    public $otp3;
    #[Validate('required')]
    public $otp4;
    #[Validate('required')]
    public $otp5;

    public $otpInfo = null;
    public function mount($id)
    {
        $otpId = Crypt::decryptString($id);
        $this->otpInfo = Otp::with(['customerInfo'])->where('id',$otpId)->first();


    }
    public function resend()
    {
        $randomNumber =rand(10000, 99999);
        $this->otpInfo->update([
            'otp'=>$randomNumber,
        ]);
        $response = Http::post('https://semaphore.co/api/v4/messages',[
            'apikey' => '7338bafb9fef713705ea897a234722cf', //Your API KEY
            'number' => $this->otpInfo->customerInfo->contact,
            'message' => 'OTP:'.$randomNumber,
            'sendername' => 'SEMAPHORE'
        ]);
        Notification::make()
        ->title('New OTP Send to your number')
        ->success()
        ->send();
    }
    public function checkOtp()
    {
        $this->validate();
        $frontendOtp = $this->otp1.$this->otp2.$this->otp3.$this->otp4.$this->otp5;
        if($frontendOtp == $this->otpInfo['otp'])
        {
            Customer::where('id',$this->otpInfo['customer_id'])->update([
                'contact_verify'=>true
            ]);
            Notification::make()
            ->title('OTP verified successfully')
            ->success()
            ->send();
            return redirect()->route('login');
        }else{
            Notification::make()
            ->title('The entered OTP is incorrect.')
            ->danger()
            ->send();
        }
    }
    public function render()
    {
        return view('livewire.auth.opt');
    }
}
