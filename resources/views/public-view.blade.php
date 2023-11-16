<x-public-layout>
    <div class="w-full prose prose-slate max-w-none">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-2">
            <h1 class="pb-0 mt-[1em] mb-0 text-center">{{$page->title}}</h1>
            <br/>
            <div class="py-4 overflow-hidden bg-white dark:bg-gray-800">
                {!! \Illuminate\Support\Str::markdown($page->content) !!}
            </div>
        </div>
    </div>
</x-public-layout>