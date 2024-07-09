@assets
    <style>
        .fi-tabs-item-active {
            color: red !important;
        }
    </style>
@endassets
<div x-data="main">
    {{-- header --}}
    <x-header :cart="$cart_count"/>

    {{-- main content --}}
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-auto rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img class="w-full h-auto object-scale-down" src="{{ asset('storage/'.$product->image) }}" alt="Product Image">
                    </div>

                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $product->name }}</h2>

                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 ">Price:</span>
                            <span class="text-gray-600 ">₱ {{ number_format($product->price,2) }}</span>
                        </div>
                        <div>
                            <span class="font-bold text-gray-700 ">Availability:</span>
                            <span class="text-gray-600 ">In Stock</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <span class="font-bold text-gray-700 ">Quantity:</span>
                        <div class="flex items-center mt-2">
                            <input type="number" wire:model='quantity' class="w-20 text-center" min="1" value="{{ $quantity }}" >
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-gray-700 ">Product Description:</span>
                        <p class="text-gray-600  text-sm mt-2">
                            {!! $product->description !!}
                        </p>
                    </div>
                    <div class="flex -mx-2 mt-4">
                        <div class="w-1/2 px-2">
                            <button wire:click='addToCart' class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700">Add to Cart</button>
                        </div>

                    </div>
                </div>
            </div>
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
            init() {


            }
        }))
    </script>
@endscript
