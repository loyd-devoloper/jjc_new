<?php

namespace App\Livewire\Customer;

use App\Models\Cart;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class TermAndCondition extends Component
{
    #[Title('Term & Condition')]
    public function render()
    {
        $cart_count = Cart::where('customer_id',Auth::guard('customer')->id())->count();
        return view('livewire.customer.term-and-condition',compact('cart_count'));
    }
}
