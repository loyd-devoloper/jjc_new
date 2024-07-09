@assets
    <style>
        .fi-tabs-item-active {
            color: red !important;
        }

        /* HTML: <div class="loader"></div> */
        .loader {
            width: fit-content;
            font-weight: bold;
            font-family: sans-serif;
            font-size: 30px;
            padding-bottom: 8px;
            background: linear-gradient(currentColor 0 0) 0 100%/0% 3px no-repeat;
            animation: l2 2s linear infinite;
        }

        .loader:before {
            content: "Loading..."
        }

        @keyframes l2 {
            to {
                background-size: 100% 3px
            }
        }
    </style>
@endassets

<div x-data="main">

    {{-- header --}}
    <x-header :cart="$cart_count" />

    {{-- header with sort --}}
    <section class="mx-auto w-full max-w-screen-xl pt-20 px-4 xl:px-0">
        <div class=" mb-4 mr-4">
            <h1 class="text-3xl font-bold">New Arrivals</h1>
            {{-- <div class="relative inline-block text-left">
                <div>
                    <button type="button" x-on:click="sortDropdown = !sortDropdown"
                        class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                        id="menu-button" aria-expanded="false" aria-haspopup="true">
                        Sort
                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>


                <div x-cloak x-show="sortDropdown" x-transition
                    class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none "
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">

                        <a href="#" class="font-medium text-gray-900 block px-4 py-2 text-sm" role="menuitem"
                            tabindex="-1" id="menu-item-0">Most Popular</a>
                        <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-1">Best Rating</a>
                        <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-2">Newest</a>
                        <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-3">Price: Low to High</a>
                        <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-4">Price: High to Low</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <hr class="bg-red-500 ">
    </section>
    <main class="mx-auto w-full max-w-screen-xl flex px-4 xl:px-0 relative">
        {{-- loading --}}


        <aside class="min-w-[17rem] max-w-[17rem] hidden xl:block">
            <div class="border-b border-gray-300 px-4 py-6">
                <h3 class="-mx-2 -my-3 flow-root">
                    <!-- Expand/collapse section button -->
                    <button type="button" x-on:click="categoryButton = !categoryButton"
                        class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                        aria-controls="filter-section-mobile-1" aria-expanded="false">
                        <span class="font-medium text-gray-900">Category</span>
                        <span class="ml-6 flex items-center">
                            <!-- Expand icon, show/hide based on section open state. -->
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            <!-- Collapse icon, show/hide based on section open state. -->
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </h3>
                <!-- Filter section, show/hide based on section state. -->
                <form wire:submit.prevent='showPruduct' class="pt-6" x-show="categoryButton" x-transition
                    id="filter-section-mobile-1">

                    <div class="space-y-6">
                        <div class="flex items-center">
                            <input wire:model.live="category" value="" type="radio"
                                class="h-4 w-4  text-indigo-600 ">
                            <label class="ml-3 text-sm min-w-0 flex-1 text-gray-500">All</label>
                        </div>
                        @forelse ($categories as $cat)
                            <div class="flex items-center">
                                <input wire:model.live="category" value="{{ $cat->id }}" id="{{ $cat->name }}"
                                    type="radio" class="h-4 w-4  text-indigo-600 ">
                                <label for="{{ $cat->name }}"
                                    class="ml-3 text-sm min-w-0 flex-1 text-gray-500">{{ $cat->name }}</label>
                            </div>
                        @empty
                        @endforelse


                    </div>
                </form>
            </div>
        </aside>

        <div class=" relative overflow-hidden w-full p-10">

            <select wire:model.live="category" id="" class="w-full mb-10 block xl:hidden">
                <option value="">Categories</option>
                @forelse ($categories as $cat)
                    <div class="flex items-center">
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    </div>
                @empty
                @endforelse
            </select>
            <div wire:loading wire:target='category' class=" w-full top-0 left-0  flex justify-center">
                <div class="loader mx-auto "></div>
            </div>
            <section wire:loading.remove wire:target='category' class="mx-auto container  ">
                {{-- <img src="{{ asset('428366392_1300604220887288_1441141749179865630_n.jpg') }}" class="absolute h-full object-cover  w-full left-0 -z-10" alt=""> --}}
                {{-- <div wire:loading wire:target='products' width="800px" class=" w-full flex justify-center pt-6">
                    <svg height="800px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"
                        class="w-8 h-8 animate-spin mx-auto ">

                        <g fill="#000000" fill-rule="evenodd" clip-rule="evenodd">

                            <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z"
                                opacity=".2" />

                            <path
                                d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z" />

                        </g>

                    </svg>
                </div> --}}
                {{-- wire:loading.class='hidden' --}}
                <div class="grid grid-cols-1 justify-center sm:grid-cols-2 xl:grid-cols-3 gap-10 ">

                    @forelse ($products as $product)
                        <div
                            class="w-full max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow hover:scale-105 hover:shadow-md duration-500">
                            <a
                                href="{{ route('product.view', ['id' => Illuminate\Support\Facades\Crypt::encryptString($product->id)]) }}">
                                <img class="p-2 rounded-t-lg" src="{{ asset('storage/' . $product->image) }}"
                                    alt="product image" />
                            </a>
                            <div class="px-3 pb-5">
                                <a
                                    href="{{ route('product.view', ['id' => Illuminate\Support\Facades\Crypt::encryptString($product->id)]) }}">
                                    <h5 class="text-base font-semibold tracking-tight line-clamp-2 text-gray-900 ">
                                        {{ $product->name }}
                                    </h5>
                                </a>

                                <div class="flex items-center justify-between mt-10">
                                    <span class="text-3xl font-bold text-gray-900  flex items-center">
                                        <svg fill="#000000" class="h-7 w-7" viewBox="0 0 36 36" version="1.1"
                                            preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>peso-line</title>
                                            <path
                                                d="M31,13.2H27.89A6.81,6.81,0,0,0,28,12a7.85,7.85,0,0,0-.1-1.19h2.93a.8.8,0,0,0,0-1.6H27.46A8.44,8.44,0,0,0,19.57,4H11a1,1,0,0,0-1,1V9.2H7a.8.8,0,0,0,0,1.6h3v2.4H7a.8.8,0,0,0,0,1.6h3V31a1,1,0,0,0,2,0V20h7.57a8.45,8.45,0,0,0,7.89-5.2H31a.8.8,0,0,0,0-1.6ZM12,6h7.57a6.51,6.51,0,0,1,5.68,3.2H12Zm0,4.8H25.87a5.6,5.6,0,0,1,0,2.4H12ZM19.57,18H12V14.8H25.25A6.51,6.51,0,0,1,19.57,18Z"
                                                class="clr-i-outline clr-i-outline-path-1"></path>
                                            <rect x="0" y="0" width="36" height="36" fill-opacity="0" />
                                        </svg>{{ $product->price }}</span>
                                    <button
                                        wire:click.prevent='addToCart("{{ Illuminate\Support\Facades\Crypt::encryptString($product->id) }}")'
                                        class="  font-medium rounded-lg text-sm pr-2 py-2.5 text-center hover:opacity-50">
                                        <img src="{{ asset('asset/cart.png') }}" class="w-8 h-8" alt="">
                                        {{-- <svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg> --}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    @empty
                        <h1>No product Found!</h1>
                    @endforelse

                </div>

            </section>
        </div>
    </main>

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
