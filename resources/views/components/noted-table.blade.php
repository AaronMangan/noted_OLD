@props(['type' => 'table-auto', 'tableData' => $tableData ?? []])
<div>
    <table class="{{ $type }} w-full mt-3 border-collapse border border-gray-400">
        <thead class="m-1 text-white bg-gray-400">
            <tr>
                @foreach(array_keys($tableData[0]) as $header)
                    <th class="capitalize border">{{ $header }}</th>
                @endforeach
                    <th class="capitalize border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tableData as $key => $value)
                <tr>

                    @foreach($value as $cell)
                        <td class="text-center border">{{ $cell }}</td>
                    @endforeach
                    <td class="text-center border">
                        <button class="px-2 py-1 m-1 text-xs text-center text-white bg-gray-600 rounded-md font-sm hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Edit</button>
                        <button class="px-2 py-1 m-1 text-xs text-center text-white bg-red-600 rounded-md font-sm hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
