@props(['type' => 'table-auto', 'tableData' => $tableData ?? []])
<div>
    @if(empty($tableData))
        <p class="m-3 text-center text-gray-300">No Tags to display</p>
    @else
        <table class="{{ $type }} w-full mt-3 border-collapse border border-gray-400">
            <thead class="m-1 text-white bg-gray-400">
                <tr class="border">
                    <th class="capitalize border">Name</th>
                    <th class="capitalize border">Description</th>
                    <th class="capitalize border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tableData as $key => $value)
                    <tr>
                        <td class="text-center border">{{ $value['name']}}</td>
                        <td class="pl-2 border">{{ $value['description'] }}</td>
                        <td class="text-center border d-inline-flex">
                            <form method="post" action="{{ route('tags.destroy', $value['id']) }}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="px-2 py-1 m-1 text-xs text-center text-white bg-red-600 rounded-md d-inline-flex font-sm hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                <button type="button" class="px-2 py-1 m-1 text-xs text-center text-white bg-gray-600 rounded-md d-inline-flex font-sm hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Edit</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
