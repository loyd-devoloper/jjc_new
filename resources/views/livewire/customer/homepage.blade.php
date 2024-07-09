<div x-data="main">
    {{-- header --}}
    <x-header :cart="$cart_count" />
    {{-- hero section --}}
    <div class="swiper  " x-ref="container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper   max-h-[90svh]">
            <!-- Slides -->
            <img class="swiper-slide object cover "
                src="{{ asset('welding machines/118702448_3190770591042671_2573396653260986107_n.jpg') }}"
                alt="carousel image" class="object-cover object-top" />
            <img class="swiper-slide object cover "
                src="{{ asset('welding machines/118694401_3190770501042680_147853573047019205_n.jpg') }}"
                alt="carousel image" class="object-cover object-top" />
            <img class="swiper-slide object cover object-bottom"
                src="{{ asset('welding machines/118540920_3190770867709310_8478403207550914839_n.jpg') }}"
                alt="carousel image" class="object-cover object-top" />


        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    {{-- latest Product --}}
    <section class="mx-auto w-full max-w-screen-xl  bg-transparent pb-32 px-4 md:px-0">

        <h1 class="text-center py-20 font-extrabold text-4xl">Latest Product</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 justify-center   gap-10 ">

            @foreach ($productsLatest as $product)
                <div
                    class="w-full mx-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow hover:scale-105 hover:shadow-md duration-500">
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

                        <div class="flex items-center justify-end mt-10">
                            {{-- <span class="text-3xl font-bold text-gray-900  flex items-center">
                                <svg fill="#000000" class="h-7 w-7" viewBox="0 0 36 36" version="1.1"
                                    preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>peso-line</title>
                                    <path
                                        d="M31,13.2H27.89A6.81,6.81,0,0,0,28,12a7.85,7.85,0,0,0-.1-1.19h2.93a.8.8,0,0,0,0-1.6H27.46A8.44,8.44,0,0,0,19.57,4H11a1,1,0,0,0-1,1V9.2H7a.8.8,0,0,0,0,1.6h3v2.4H7a.8.8,0,0,0,0,1.6h3V31a1,1,0,0,0,2,0V20h7.57a8.45,8.45,0,0,0,7.89-5.2H31a.8.8,0,0,0,0-1.6ZM12,6h7.57a6.51,6.51,0,0,1,5.68,3.2H12Zm0,4.8H25.87a5.6,5.6,0,0,1,0,2.4H12ZM19.57,18H12V14.8H25.25A6.51,6.51,0,0,1,19.57,18Z"
                                        class="clr-i-outline clr-i-outline-path-1"></path>
                                    <rect x="0" y="0" width="36" height="36" fill-opacity="0" />
                                </svg>{{ $product->price }}</span> --}}
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
            @endforeach




        </div>

    </section>
    <div class="bg-[#ffffff] relative overflow-hidden pb-20 px-4 md:px-0">
        <section class="mx-auto w-full max-w-screen-xl px-4 ">
            {{-- <img src="{{ asset('428366392_1300604220887288_1441141749179865630_n.jpg') }}" class="absolute h-full object-cover  w-full left-0 -z-10" alt=""> --}}
            <div class="justify-between flex items-center">
                <h1 class=" py-20 font-bold text-4xl">Best Product</h1>
                <a href="{{ route('product') }}" class="text-blue-500 font-bold hover:underline">View all</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 justify-center gap-10">

                @foreach ($productsLatest as $product)
                    <div
                        class="w-full mx-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow hover:scale-105 hover:shadow-md duration-500">
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

                            <div class="flex items-center justify-end mt-10">
                                {{-- <span class="text-3xl font-bold text-gray-900  flex items-center">
                                    <svg fill="#000000" class="h-7 w-7" viewBox="0 0 36 36" version="1.1"
                                        preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>peso-line</title>
                                        <path
                                            d="M31,13.2H27.89A6.81,6.81,0,0,0,28,12a7.85,7.85,0,0,0-.1-1.19h2.93a.8.8,0,0,0,0-1.6H27.46A8.44,8.44,0,0,0,19.57,4H11a1,1,0,0,0-1,1V9.2H7a.8.8,0,0,0,0,1.6h3v2.4H7a.8.8,0,0,0,0,1.6h3V31a1,1,0,0,0,2,0V20h7.57a8.45,8.45,0,0,0,7.89-5.2H31a.8.8,0,0,0,0-1.6ZM12,6h7.57a6.51,6.51,0,0,1,5.68,3.2H12Zm0,4.8H25.87a5.6,5.6,0,0,1,0,2.4H12ZM19.57,18H12V14.8H25.25A6.51,6.51,0,0,1,19.57,18Z"
                                            class="clr-i-outline clr-i-outline-path-1"></path>
                                        <rect x="0" y="0" width="36" height="36" fill-opacity="0" />
                                    </svg>{{ $product->price }}</span> --}}
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
                @endforeach



            </div>

        </section>
    </div>


    {{-- footer --}}
    <x-footer />


</div>
@script
    <script>
        Alpine.data('main', () => ({
            open: false,
            swiper: null,
            toggle() {
                this.open = !this.open
            },
            init() {

                this.swiper = new Swiper(this.$refs.container, {

                    direction: 'horizontal',
                    loop: true,


                    pagination: {
                        el: '.swiper-pagination',
                    },


                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    autoplay: {

delay: 2000, // autoplay every 5 seconds

disableOnInteraction: false, // autoplay will not be disabled after user interaction

},

                })
            }
        }))
    </script>
@endscript
