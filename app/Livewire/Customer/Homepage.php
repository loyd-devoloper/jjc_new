<?php

namespace App\Livewire\Customer;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Filament\Notifications\Notification;

class Homepage extends Component
{
    public function addToCart($product_id)
    {
        if(!Auth::guard('customer')->check())
        {
            Notification::make()
            ->title('Login first')
            ->warning()
            ->send();
        }else{

            $check = Cart::where('customer_id',Auth::guard('customer')->id())->where('product_id',Crypt::decryptString($product_id))->first();
            if($check)
            {
                $check->update([
                    'quantity'=>(int)$check->quantity + 1

                ]);
            }else{
                Cart::query()->create([
                    'product_id'=>Crypt::decryptString($product_id),
                    'customer_id'=>Auth::guard('customer')->id(),
                    'quantity'=>1

                ]);
            }

            Notification::make()
            ->title('Success add to cart')
            ->success()
            ->send();
        }

    }
    #[Title('Homepage')]
    public function render()
    {
        $productsLatest = Inventory::limit(3)->latest()->get();
        $cart_count = Cart::where('customer_id',Auth::guard('customer')->id())->count();
        return view('livewire.customer.homepage',compact('cart_count','productsLatest'));
    }
}
