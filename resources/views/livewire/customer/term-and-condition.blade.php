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
        <div class="mx-auto w-full max-w-screen-md  p-8 bg-white rounded-md shadow-md space-y-6">
            <h2 class="text-2xl font-semibold mb-6">Terms and Conditions</h2>

            <p>Certainly, here's the updated terms and conditions with the Facebook contact information included:</p>

            <h1 class="font-bold">*Terms and Conditions: No-Refund Policy*</h1>

            <p>By placing an order or reserving an item at JJC General Store, you agree to abide by the following terms and conditions:
            </p>

            <h1 class="">
                1. <span class="font-bold">*Reservation and Purchase*:</span> When you reserve or purchase an item from JJC General Store, you acknowledge that the reservation or purchase is final and binding.
            </h1>


            <h1 class="">
                2. <span class="font-bold">*No Refunds*:</span> JJC General Store operates on a strict no-refund policy. Once an item is reserved or purchased, no refunds will be provided under any circumstances.
            </h1>

            <h1 class="">
                3. <span class="font-bold">*Quality Assurance*: </span> We take great care to ensure that all items listed for reservation or purchase meet our quality standards. However, if you encounter any issues with the item received, please contact us within [number of days] days of receiving the item for assistance.
            </h1>
            <h1 class="">
                4. <span class="font-bold">*Exchange Policy*:</span> In certain cases, JJC General Store may allow exchanges for items of equal or lesser value, subject to availability and our discretion. Any exchanges must be initiated within [number of days] days of receiving the item and are subject to inspection and approval by JJC General Store.
            </h1>

            <h1 class="">
                5. <span class="font-bold">*Damaged or Defective Items*:</span>If you receive a damaged or defective item, please contact us immediately with photographic evidence of the damage or defect. We will assess the situation and provide further instructions on how to proceed.
            </h1>

            <h1 class="">
                6. <span class="font-bold">*Cancellation Policy*:</span>Orders or reservations cannot be canceled once confirmed. Please review your order carefully before finalizing your purchase.
            </h1>

            <h1 class="">
                7. <span class="font-bold">*Modification of Terms*: </span>JJC General Store reserves the right to modify these terms and conditions at any time without prior notice. Any changes will be effective immediately upon posting on our website or notifying customers through other means.
            </h1>

            <h1 class="">
                8. <span class="font-bold">*Contact Information*:</span>  - Facebook Page: [JJC General Store Facebook Page](https://www.facebook.com/jjc.genmdsg)
            </h1>
            <h1 class="">
                9. <span class="font-bold"> *Governing Law*:</span> These terms and conditions shall be governed by and construed in accordance with the laws of [Jurisdiction]. Any disputes arising out of or related to these terms and conditions shall be subject to the exclusive jurisdiction of the courts of [Jurisdiction].
            </h1>

            <h1 class="">
                By proceeding with your reservation or purchase, you acknowledge that you have read, understood, and agreed to these terms and conditions in their entirety.
            </h1>
            <h1 class="">
                If you have any questions or concerns regarding these terms and conditions, please contact us at the provided Facebook Page or additional contact information if applicable.
            </h1>
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
