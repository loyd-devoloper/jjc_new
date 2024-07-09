<?php

namespace App\Livewire\Customer;

use App\Models\Inventory;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Illuminate\Support\Env;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

class Cart extends Component
{
    public $total = 0;
    public $subtotal = 0;
    public $shipping = 150;
    public $downpayment = 0;
    public $downpaymentTotal = 0;
    #[Validate('required')]
    public $payment_method = '';

    public $allItems = [];


    public function updating($property, $value)
    {
        if ($property == 'payment_method') {
            if ($value == 'downpayment') {
                $this->total = 0;
            }
        }
    }

    public function checkout()
    {


        $this->validate();
        if($this->payment_method == 'downpayment')
        {
            $price = $this->downpayment;
            $dbPrice = $this->downpaymentTotal;
            $dbDownpayment = $this->downpayment;
        }else{
            $price = $this->total;
            $dbPrice = $this->total;
            $dbDownpayment = null;
        }
        $api_key = 'sk_test_A8xf234vNneM4gXAv8ZKEDJ2';
        try {

            $response = Http::withHeaders([
                'authorization' => 'Basic ' . base64_encode($api_key),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://api.paymongo.com/v1/checkout_sessions',  [
                'data' => [
                    'attributes' => [
                        'send_email_receipt' => false,
                        'show_description' => true,
                        'show_line_items' => false,
                        'billing_information_fields_editable' => false,
                        'cancel_url' => 'https://developers.paymongo.com/reference/create-a-checkout',
                        'success_url' => Env('APP_URL').'/customer/my-orders',
                        'billing' => [
                            'name' => Auth::guard('customer')->user()->fullname,
                            'email' =>Auth::guard('customer')->user()->email,
                            'phone' => Auth::guard('customer')->user()->contact,
                        ],
                        'description' => 'JJC ORDER',
                        'line_items' => [
                            [
                                'currency' => 'PHP',
                                'amount' => (int)$price * 100,
                                'description' => 'JJC ORDER',
                                'name' => 'dsadadad',
                                'quantity' => 1,
                            ]
                        ],
                        'payment_method_types' => ['gcash'],

                    ],
                ],
            ])->json();
            $referencePaymentId = 'PAY' . strtoupper(Str::random(8));
            $order = \App\Models\Orders::create([
                'ref'=>$referencePaymentId,
                'customer_id' => Auth::guard('customer')->id(),
                'price' => $dbPrice,
                'payment_type' => $this->payment_method,
                'paymongo_id' => $response['data']['id'],
                'status' => 'processing',
                'downpayment' =>  $dbDownpayment,
                'payment_status' => 'pending',
                'checkout_url'=>$response['data']['attributes']['checkout_url']
            ]);
            foreach ($this->allItems as $item) {
               OrderItem::create([
                'order_id'=>$order->id,
                'product_id' => $item->product_id,
                'quantity'=>$item->quantity
               ]);
            }
            $carts = \App\Models\Cart::with(['productInfo'])->where('customer_id', Auth::guard('customer')->id())->latest()->get();
            foreach($carts as $cart)
            {

                if(($cart->productInfo && $cart->productInfo->stock > 10))
                {
                    $cart->productInfo->update([
                        'stock'=>(int) $cart->productInfo->stock - (int)$cart->quantity
                    ]);
                }


            }
            return response()->json($response['data']['attributes']['checkout_url']);
        } catch (\Exception $e) {
            // Handle exception
            dd($e->getMessage());
        }
    }
    public function updateQuantity($id, $value)
    {
        \App\Models\Cart::where('customer_id', Auth::guard('customer')->id())
            ->where('id', $id)->update([
                'quantity' => $value
            ]);
    }
    public function removePruduct($product_id)
    {
        \App\Models\Cart::where('customer_id', Auth::guard('customer')->id())
            ->where('id', $product_id)->delete();
        Notification::make()
            ->title('Deleted successfully')
            ->success()
            ->send();
    }
    #[Title('Cart')]
    public function render()
    {
        $this->subtotal = 0;
        $this->total = 0;
        $this->downpayment = 0;
        $carts = \App\Models\Cart::with(['productInfo'=>function($query){
             $query->with('categoryInfo');
        }])->where('customer_id', Auth::guard('customer')->id())->latest()->get();

        $this->allItems = $carts;
        foreach ($carts as $cart) {
            $this->subtotal += (int)$cart->productInfo->price * (int)$cart->quantity;
        }
        if ($this->payment_method == 'downpayment') {
            $this->shipping = 150;
            $this->downpayment = (int)$this->subtotal * 0.3;
            $this->total = (int)$this->shipping + (int)($this->subtotal * 0.3);
            $this->downpaymentTotal = (int)$this->shipping + (int)$this->subtotal;

        } elseif ($this->payment_method == 'pickup') {
            $this->shipping = 0;
            $this->total = (int)$this->shipping + (int)$this->subtotal;
        } else {
            $this->total = (int)$this->shipping + (int)$this->subtotal;
        }
        $cart_count = \App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->count();
        return view('livewire.customer.cart', compact('cart_count', 'carts'));
    }
}
