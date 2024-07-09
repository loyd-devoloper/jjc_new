<?php

namespace App\Livewire\Customer;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Filament\Notifications\Notification;

class Product extends Component
{
    use WithPagination;
    public $category = '';
    public $categories = [];


    public function mount()
    {
        $this->categories = Category::get();



    }


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
    #[Title('Products')]
    public function render()
    {
        if(!!$this->category)
        {
            $products = Inventory::where('category',$this->category)->paginate(10);
        }else{
            $products = Inventory::paginate(10);
        }
        sleep(1);
        $cart_count = Cart::where('customer_id',Auth::guard('customer')->id())->count();
        return view('livewire.customer.product',compact('products','cart_count'));
    }
}
