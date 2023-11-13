<x-app-layout>
    <div class="w-full prose bg-white prose-slate max-w-none">
        <div class="mx-auto bg-white max-w-7xl sm:px-2 lg:px-2">
            <h1 class="pb-0 mt-[1em] bg-white mb-0 text-center">{{$page->title}}</h1>
            <div class="flex inline-flex items-center justify-center w-full">
                <a class="mr-2 text-xs text-gray-400 cursor-pointer" onclick='window.location="{{route('dashboard')}}"'>Back</a>
                <span class="text-xs text-gray-300">|</span>
                <a class="ml-2 mr-2 text-xs text-gray-400 cursor-pointer" onclick='window.location="{{route('settings.create', $page->id)}}"'>Settings</a>
                @if(\Auth::user()->can('manage-page', $page, \Auth::user()))
                    <span class="text-xs text-gray-300">|</span>
                    <a class="ml-2 text-xs text-gray-400 cursor-pointer" onclick='window.location="{{route('pages.edit', $page->id)}}"'>Edit</a>
                @endif
            </div>
            <div class="py-4 overflow-hidden bg-white dark:bg-gray-800">
                {!! \Illuminate\Support\Str::markdown($page->content) !!}
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.querySelector("body > div.min-h-screen.bg-gray-100.dark\\:bg-gray-900").style.background = "#fff";
</script>