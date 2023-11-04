<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $page->title }}
        </h2>
    </x-slot>

    <div class="w-full py-12 prose prose-slate max-w-none">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white dark:bg-gray-800">
                {!! \Illuminate\Support\Str::markdown($page->content) !!}
            </div>
        </div>
    </div>
    @if (session('status') === 'success')
        <!-- Show the flash message -->
    @endif
</x-app-layout>