@assets
    <style>
        .fi-tabs-item-active {
            color: red !important;
        }
    </style>
@endassets
<div x-data="main">
    {{-- header --}}
    <x-header :cart="$cart_count" />

    {{-- main content --}}

    <div class="pb-20 bg-gray-100 pt-20 container mx-auto  px-4">
        <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
        <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="rounded-lg md:w-2/3 max-h-[30rem] overflow-y-auto">
                @foreach ($carts as $cart)
                   @if ($cart->productInfo && $cart->productInfo->stock > 10)
                   <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                    <img src="{{ asset('storage/' . $cart->productInfo->image) }}" alt="product-image"
                        class="w-full rounded-lg sm:w-40" />
                    <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                        <div class="mt-5 sm:mt-0">
                            <a href="{{ route('product.view', ['id' => Illuminate\Support\Facades\Crypt::encryptString($cart->productInfo->id)]) }}"
                                class="text-lg font-bold text-gray-900">{{ $cart->productInfo->name }}</a>
                            <p class="mt-1 text-xs text-gray-700">{{ $cart->productInfo?->categoryInfo?->name }}</p>
                        </div>
                        <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                            <div class="flex items-center border-gray-100">

                                <input x-on:change='changeQuantity({{ $cart->id }})'
                                    class="h-10 w-20 border bg-white text-center text-xs outline-none"
                                    type="number" value="{{ $cart->quantity }}" min="1" />

                            </div>
                            <div class="flex items-center space-x-4">
                                <p class="text-sm">PHP {{ $cart->productInfo->price }}</p>
                                <svg wire:click='removePruduct({{ $cart->id }})'
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                   @endif
                @endforeach

            </div>
            <!-- Sub total -->

            @if ($carts->count() > 0)
                <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                    <div class="mb-5 grid justify-between">
                        <p class="text-gray-700">Payment Method:</p>
                        <select wire:model.live='payment_method' class="w-full ">
                            <option value="">Choose...</option>
                            @if ($total <= 5000)
                                <option value="cod">Cash on Delivery</option>
                            @endif
                            <option value="downpayment">Downpayment via gcash</option>
                            <option value="pickup">Pickup</option>
                        </select>
                        @error('payment_method')
                            <small class="text-red-500"> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2 flex justify-between">
                        <p class="text-gray-700">Subtotal</p>
                        <p class="text-gray-700">{{ number_format($subtotal, 2) }} PHP</p>
                    </div>
                    @if ($payment_method == 'downpayment')
                        <div class="mb-2 flex justify-between">
                            <p class="text-gray-700">Downpayment</p>
                            <p class="text-gray-700">{{ number_format($downpayment, 2) }} PHP</p>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <p class="text-gray-700">Shipping</p>
                        <p class="text-gray-700">{{ number_format($shipping, 2) }} PHP</p>
                    </div>
                    <hr class="my-4" />
                    <div class="flex justify-between">
                        <p class="text-lg font-bold">Total</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold">{{ number_format($total, 2) }} PHP</p>
                            <p class="text-sm text-gray-700">including VAT</p>
                        </div>
                    </div>
                    <button x-on:click="checkout" wire:loading.remove
                        class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check
                        out</button>
                    <button x-on:click="checkout" wire:loading.class.remove='hidden'
                        class="mt-6 w-full rounded-md hidden bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600"
                        disabled>Loading...</button>
                </div>
            @endif
        </div>
    </div>
    {{-- footer --}}
    <x-footer />


</div>
@script
    <script>
        Alpine.data('main', () => ({
            open: false,
            sortDropdown: false,
            categoryButton: true,
            swiper: null,
            toggle() {
                this.open = !this.open
            },
            async checkout() {
                const url = await $wire.checkout();
                window.open(url.original, '_blank');
            },
            changeQuantity(cartId) {
                $wire.updateQuantity(cartId, event.target.value)
            },
            init() {


            }
        }))
    </script>
@endscript
