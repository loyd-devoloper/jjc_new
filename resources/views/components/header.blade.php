<div x-data="{ mobile: false }" class="border-b bg-white  w-full px-4 xl:px-0">
    <header class=" h-[5rem] flex items-center justify-between mx-auto w-full max-w-screen-xl px-4 md:px-0  ">
        <div class="flex items-center gap-2">
            <img src="{{ asset('logo.png') }}" class="w-[3.5rem]" alt="">
            <p class="font-bold text-2xl hidden lg:block">JJC GENERAL STORE</p>
            <p class="font-bold text-2xl block lg:hidden">JJC </p>
        </div>
        <div class="hidden md:flex items-center gap-4">
            <a href="{{ route('homepage') }}" wire:navigate
                class="text-sm {{ request()->routeIs('homepage') ? 'font-bold' : '' }}">HOMEPAGE</a>
            <a href="{{ route('product') }}" wire:navigate
                class="text-sm {{ request()->routeIs('product') ? 'font-bold' : '' }}">PRODUCTS</a>

            <a href="{{ route('contact') }}" wire:navigate
                class="text-sm {{ request()->routeIs('contact') ? 'font-bold' : '' }}">CONTACT US</a>

            <div class="ml-10 flex items-center gap-5">
                <a href="{{ route('cart.customer') }}" class="flex items-center gap-1">

                    <div class="relative py-2">
                        <div class="top-2 absolute left-5">
                            <p
                                class="flex h-2 w-2 items-center justify-center rounded-full bg-red-500 p-2.5 text-xs text-white">
                                {{ $cart }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                </a>
                |
                @if (Auth::guard('customer')->check())
                    <div x-data="{ accountDropdown: false }" class="relative">
                        <button x-on:click="accountDropdown = !accountDropdown"
                            class="bg-blue-500 py-2 px-4 rounded text-white">
                            Account
                        </button>

                        <div x-cloak x-show="accountDropdown" x-transition :class="accountDropdown ? 'block' : 'hidden'"
                            class="absolute left-auto right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none "
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">

                                <a href="{{ route('profile.customer') }}"
                                    class="font-medium text-gray-900 block px-4 py-2 text-sm" role="menuitem"
                                    tabindex="-1" id="menu-item-0">Profile</a>
                                <a href="{{ route('my-orders.customer') }}"
                                    class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                    id="menu-item-1">My Orders</a>
                                <a href="{{ route('logout.customer') }}" class="text-gray-500 block px-4 py-2 text-sm"
                                    role="menuitem" tabindex="-1" id="menu-item-2">Logout</a>

                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 py-2 px-4 rounded text-white">
                        Login
                    </a>
                @endif
            </div>
        </div>
        <div x-cloak x-show="mobile" x-transition
            class="block md:hidden w-full gap-4 fixed bg-white shadow h-[100svh] top-0 z-50 right-0">
            <div class="h-fit grid  relative">
                <button class="absolute top-7 right-7" x-on:click="mobile = !mobile">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>
                <div class="mt-28 px-3 grid gap-2">
                    <a href="{{ route('homepage') }}" wire:navigate
                        class="text-base {{ request()->routeIs('homepage') ? 'font-bold' : '' }}">HOMEPAGE</a>
                    <a href="{{ route('product') }}" wire:navigate
                        class="text-base {{ request()->routeIs('product') ? 'font-bold' : '' }}">PRODUCTS</a>

                    <a href="{{ route('contact') }}" wire:navigate
                        class="text-base {{ request()->routeIs('contact') ? 'font-bold' : '' }}">CONTACT US</a>

                    <div class="flex items-center gap-5">
                        <a href="{{ route('cart.customer') }}" class="flex items-center gap-1">

                            <div class="relative py-2">
                                <div class="top-2 absolute left-5">
                                    <p
                                        class="flex h-2 w-2 items-center justify-center rounded-full bg-red-500 p-2.5 text-xs text-white">
                                        {{ $cart }}</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                        </a>
                        |
                        @if (Auth::guard('customer')->check())
                            <div x-data="{ accountDropdown: false }" class="relative">
                                <button x-on:click="accountDropdown = !accountDropdown"
                                    class="bg-blue-500 py-2 px-4 rounded text-white">
                                    Account
                                </button>

                                <div x-cloak x-show="accountDropdown" x-transition
                                    :class="accountDropdown ? 'block' : 'hidden'"
                                    class="absolute left-auto right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none "
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                    tabindex="-1">
                                    <div class="py-1" role="none">

                                        <a href="{{ route('profile.customer') }}"
                                            class="font-medium text-gray-900 block px-4 py-2 text-sm" role="menuitem"
                                            tabindex="-1" id="menu-item-0">Profile</a>
                                        <a href="{{ route('my-orders.customer') }}"
                                            class="text-gray-500 block px-4 py-2 text-sm" role="menuitem"
                                            tabindex="-1" id="menu-item-1">My Orders</a>
                                        <a href="{{ route('logout.customer') }}"
                                            class="text-gray-500 block px-4 py-2 text-sm" role="menuitem"
                                            tabindex="-1" id="menu-item-2">Logout</a>

                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-500 py-2 px-4 rounded text-white">
                                Login
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button class="block md:hidden" x-on:click="mobile = !mobile">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

        </button>
    </header>
</div>
