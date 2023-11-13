<div class="mx-auto mr-4 max-w-7xl sm:px-6 lg:px-8">
    <form method="get" action="{{ route('dashboard') }}">
    @csrf
    <div class="flex columns-2">
        <div class="w-full col">
            <x-text-input :value="old('search', $search)" name="search" id="search" class="w-full"></x-text-input>
        </div>
        <div class="col">
            <button type="submit" class="px-2 py-1 m-1 ml-2 text-center text-white bg-gray-600 rounded-md text-md font-sm hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                <span class="inline mr-2 fa-solid fa-magnifying-glass"></span>Search
            </button>
        </div>
    </div>
    </form>
</div>
