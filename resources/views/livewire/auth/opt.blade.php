@assets
    <style>
        .fi-tabs-item-active {
            color: red !important;
        }
    </style>
@endassets
<div x-data="main">
    {{-- header --}}
    <x-header :cart="0" />

    {{-- main content --}}
    <div class="container mx-auto flex justify-center py-16">
        <div class="w-full max-w-md px-8 py-10 bg-white rounded-lg shadow-md dark:bg-gray-950 dark:text-gray-200">
            <h1 class="text-2xl font-semibold text-center mb-6">Enter OTP</h1>
            <p class="text-gray-600 text-center mb-4">Code sent to {{ $otpInfo->customerInfo?->contact }}</p>
            <div class="grid grid-cols-5 gap-x-4 my-2">
              <div contenteditable="true"  class="rounded-lg bg-gray-100 cursor-text  w-14 aspect-square flex items-center justify-center">
                <input class="text-gray-700  h-full outline-none border  rounded  {{ $errors->has('otp1') ? 'border-red-500' : 'border-gray-400' }} text-center w-14 " wire:model="otp1" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && this.value.length < 1"/>
              </div>
              <div contenteditable="true"  class="rounded-lg   bg-gray-100 cursor-text  w-14 aspect-square flex items-center justify-center">
                <input class="text-gray-700  h-full outline-none border  rounded  w-14 {{ $errors->has('otp2') ? 'border-red-500' : 'border-gray-400' }} text-center " wire:model="otp2" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && this.value.length < 1"/>
              </div>
              <div contenteditable="true"  class="rounded-lg bg-gray-100 cursor-text  w-14 aspect-square flex items-center justify-center">
                <input class="text-gray-700  h-full outline-none border  rounded  w-14 {{ $errors->has('otp3') ? 'border-red-500' : 'border-gray-400' }} text-center" wire:model="otp3" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && this.value.length < 1"/>
              </div>
              <div contenteditable="true"  class="rounded-lg bg-gray-100 cursor-text  w-14 aspect-square flex items-center justify-center">
                <input type="text" class="text-gray-700  h-full outline-none border rounded  w-14 {{ $errors->has('otp4') ? 'border-red-500' : 'border-gray-400' }} text-center" wire:model="otp4" maxlength="1"  onkeypress="return event.charCode >= 48 && event.charCode <= 57 && this.value.length < 1"/>
              </div>
              <div contenteditable="true"  class="rounded-lg  bg-gray-100 cursor-text  w-14 aspect-square flex items-center justify-center">
                <input class="text-gray-700  h-full outline-none border  rounded  w-14 {{ $errors->has('otp5') ? 'border-red-500' : 'border-gray-400' }} text-center" wire:model="otp5" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && this.value.length < 1"/>
              </div>
            </div>
            {{-- <div class="flex items-center flex-col justify-between mb-6">
              <p class="text-gray-600 text-sm">Didn't receive code?</p>
              <div class="flex items-center space-x-2">

                <button class="px-3 py-2 text-sm font-medium text-center rounded text-gray-500 hover:text-blue-500">Request Again <span x-ref="time"></span></button>
              </div>
            </div> --}}
            <div class="grid grid-cols-2 gap-4 mt-10">
                <button wire:click='checkOtp' class="w-full border px-4 py-2 text-lg font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Verify</button>
                <button wire:click='resend' class="w-full px-4 py-2 text-lg font-medium text-blue-600  rounded-md hover:border-blue-600 hover:border">Resend Otp</button>
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
            checkOtp()
            {
                $wire.otp1 = this.$refs.otp1.textContent.trim();
                $wire.otp2 = this.$refs.otp2.textContent.trim();
                $wire.otp3 = this.$refs.otp3.textContent.trim();
                $wire.otp4 = this.$refs.otp4.textContent.trim();
                $wire.otp5 = this.$refs.otp5.textContent.trim();
                $wire.checkOtp();
            },

            init() {


            }
        }))
    </script>
@endscript
