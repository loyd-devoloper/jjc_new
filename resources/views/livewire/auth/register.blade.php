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
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Register</h2>

            <form wire:submit='registerCustomer' class="mt-6" autocomplete="off">
                <p class="text-red-500"></p>
                <div class="space-y-2">
                    <div><label for="fullname" class="text-gray-600 mb-2 block"></label>Fullname <input
                            type="text" wire:model="fullname" id="fullname"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400"
                            placeholder="0913213***">
                    </div>
                    @error('fullname')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <div><label for="email" class="text-gray-600 mb-2 block"></label>Email <input
                            type="email" wire:model="email" id="email"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400"
                            placeholder="0913213***">
                    </div>
                    @error('email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <div><label for="Contact" class="text-gray-600 mb-2 block"></label>Contact <input
                            type="tel" wire:model="contact" id="Contact"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400"
                            placeholder="0913213***">
                    </div>
                    @error('contact')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <div><label for="address" class="text-gray-600 mb-2 block"></label>Complete Address <input
                            type="text" wire:model="address" id="address"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400"
                            placeholder="0913213***">
                    </div>
                    @error('address')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2" x-data="{ passwordType: false }">
                    <div><label for="password" class="text-gray-600 mb-2 block"></label>Password<div class="relative">
                            <input :type="passwordType ? 'text' : 'password'" wire:model="password" id="password"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400"
                                placeholder="***********">
                            <div class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-8 text-gray-600 border-l border-gray-300"
                                x-on:click="passwordType = !passwordType">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-blue-500 border border-blue-500 rounded hover:bg-transparent hover:text-teal-500 transition uppercase font-roboto font-medium">Register</button>
                    <div class="flex gap-2 pt-5">
                        <p class="text-gray-600 text-sm">Already have an account?</p><a
                            class="text-gray-600 text-sm underline" href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </form>
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
