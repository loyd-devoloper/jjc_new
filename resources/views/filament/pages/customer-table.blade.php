<div>

<div>
    <p>
        <span>Fullname</span>: <span class="font-bold">{{ $customer?->fullname }}</span>
    </p>
    <p>
        <span>Email</span>: <span class="font-bold">{{ $customer?->email }}</span>
    </p>
    <p>
        <span>Contact</span>: <span class="font-bold">{{ $customer?->contact }}</span>
    </p>
    <p>
        <span>Address</span>: <span class="font-bold">{{ $customer?->address }}</span>
    </p>
    <p>
        <span>Date of purchase</span>: <span class="font-bold">{{ \Carbon\Carbon::parse($record?->created_at)->format('M d,Y h:m:s A') }}</span>
    </p>
</div>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product Photo
                </th>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr class="bg-white border-b ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    <img
                    src="{{ asset('storage/'.$record->productInfo->image) }}"
                    alt=""
                    style="max-width: 8rem;max-height: 8rem"
                    class=" max-w-[8rem] max-h-[8rem]"
                />
                </th>
                <td class="px-6 py-4">
                    {{ $record->productInfo->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $record->quantity }}
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>

</div>
