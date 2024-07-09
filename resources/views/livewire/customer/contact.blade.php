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
    <div class=" px-4 md:px-0 py-10">
        <div class="mx-auto w-full max-w-screen-md  p-8 bg-white rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Get in Touch</h2>
            <form wire:submit='sendContact' method="POST">
              <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
                <input type="text" id="name" wire:model="name"  required
                  class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
              </div>
              <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Your Email</label>
                <input type="email" id="email" wire:model="email"  required
                  class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
              </div>
              <div class="mb-6">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Your Message</label>
                <textarea id="message" wire:model="message" rows="4"
                  class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
              </div>
              <button type="submit" wire:loading.remove
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Send Message
              </button>
              <button wire:loading
              class="bg-blue-500 text-white px-4 w-[10rem] flex justify-center py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
              <x-filament::loading-indicator class="h-7 w-7 mx-auto" />
            </button>
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
