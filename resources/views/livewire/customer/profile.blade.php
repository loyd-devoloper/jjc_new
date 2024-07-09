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

   <section class="container mx-auto py-16">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Information</h2>
        <form x-clock x-show="passwordForm == false" wire:submit='updateInfo' class="" method="POST">
            @csrf

            <div class="mb-4">
                <label for="full_name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                <input type="text" id="full_name" wire:model="fullname" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" >
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" wire:model="email"  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" >
            </div>
            <div class="mb-4">
                <label for="contact" class="block text-gray-700 text-sm font-bold mb-2">Contact</label>
                <input type="text" id="contact" wire:model="contact"  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" >
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Complete Address</label>
                <textarea id="address" wire:model="address"  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" rows="3"></textarea>
            </div>
            {{-- <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="********">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="********">
            </div> --}}
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Update Profile</button>
                <button type="button" x-on:click="passwordForm = !passwordForm" class="w-full mt-2 bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Change password</button>
            </div>
        </form>
        <form x-clock x-show="passwordForm " wire:submit='updatePassword' class="" method="POST">
            @csrf


        <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" wire:model="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="********">
            </div>
            {{-- <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="********">
            </div> --}}
            <div>
                <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Change password</button>
                <button type="button" x-on:click="passwordForm = !passwordForm"  class="w-full flex justify-center gap-3 mt-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                  </svg>
                  Back to Profile</button>

            </div>
        </form>
    </div>
   </section>

    {{-- footer --}}
    <x-footer />


</div>
@script
    <script>
        Alpine.data('main', () => ({
            open: false,
            sortDropdown: false,
            categoryButton: true,
            passwordForm: false,
            swiper: null,
            toggle() {
                this.open = !this.open
            },
            init() {


            }
        }))
    </script>
@endscript
