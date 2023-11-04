<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="m-3 overflow-hidden bg-white dark:bg-gray-800 sm:rounded-lg">
                @foreach($pages as $page)
                    <div class="mt-2 mb-2 border-2 border-gray-100 rounded shadow-sm columns-2 d-inline">
                        <div class="w-full p-6 text-gray-800 col dark:text-gray-100">
                            {{ $page->title }}
                        </div>
                        <div class="float-right p-2 align-middle d-flex col">
                            <x-primary-button onclick="window.location='{{ URL::route('pages.show', $page->id); }}'" class="flex float-right mt-2">Save</x-primary-button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if (session('status') === 'success')
        <!-- Show the flash message -->
    @endif
</x-app-layout>
