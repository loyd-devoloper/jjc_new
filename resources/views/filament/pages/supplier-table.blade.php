<div>


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
                        src="{{ asset('storage/'.$record->image) }}"
                        alt=""
                        style="max-width: 8rem;max-height: 8rem"
                        class=" max-w-[8rem] max-h-[8rem]"
                    />
                    </th>
                    <td class="px-6 py-4">
                        {{ $record->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $record->stock }}
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    </div>
