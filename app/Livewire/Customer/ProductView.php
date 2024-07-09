<?php

namespace App\Livewire\Customer;

use App\Models\Cart;
use App\Models\Orders;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Filament\Notifications\Notification;

class ProductView extends Component
{
    public $product = [];
    public $id;
    public $title ='s';

    public $quantity = 1;

    public function mount($id)
    {

        $this->id = $id;
        $this->product = Inventory::query()->where('id',Crypt::decryptString($id))->first();
        $this->title = $this->product->name;
    }
    public function addToCart()
    {

        if(!Auth::guard('customer')->check())
        {
            Notification::make()
            ->title('Login first')
            ->warning()
            ->send();
        }else{

            $check = Cart::where('customer_id',Auth::guard('customer')->id())->where('product_id',Crypt::decryptString($this->id))->first();
            if($check)
            {
                $check->update([
                    'quantity'=>(int)$check->quantity + (int)$this->quantity

                ]);
            }else{
                Cart::query()->create([
                    'product_id'=>Crypt::decryptString($this->id),
                    'customer_id'=>Auth::guard('customer')->id(),
                    'quantity'=>(int)$this->quantity

                ]);
            }

            Notification::make()
            ->title('Success add to cart')
            ->success()
            ->send();
        }

    }

    public function render()
    {
        $cart_count = Cart::where('customer_id',Auth::guard('customer')->id())->count();
        return view('livewire.customer.product-view',compact('cart_count'))->title($this->title);
        ;
    }
}
