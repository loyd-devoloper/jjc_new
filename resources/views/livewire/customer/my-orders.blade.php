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

        {{ $this->table }}
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
            async checkout()
            {
                const url = await $wire.checkout();
                window.open(url.original, '_blank');
            },
            changeQuantity(cartId)
            {
                $wire.updateQuantity(cartId,event.target.value)
            },
            init() {


            }
        }))
    </script>
@endscript
