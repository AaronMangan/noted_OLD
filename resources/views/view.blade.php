<x-app-layout>
    <div class="w-full py-12 prose prose-slate max-w-none">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-2">
            <div class="py-4 overflow-hidden bg-white dark:bg-gray-800">
                {!! \Illuminate\Support\Str::markdown($page->content) !!}
            </div>
        </div>
    </div>
    @if (session('status') === 'success')
        <!-- Show the flash message -->
    @endif
</x-app-layout>