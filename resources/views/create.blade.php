<x-app-layout>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col space-y-1">
                    <form method="post" action="{{ route('pages.store') }}" id="new_page_form" class="space-y-1">
                        @csrf
                        <div>
                            <x-input-label for="title" class="mb-2 text-lg font-black" :value="__('Folder')" />
                            <select class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option id="-">No Folder</option>
                                @foreach($folders as $folder)
                                    <option></option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="title" class="mt-2 mb-2 text-lg font-black" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1 text-lg" :value="old('title')" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="items-center d-flex">
                            <div class="w-full">
                                <x-input-label for="title" class="my-4 text-lg font-black" :value="__('Contents')" />
                                <div id="editor" class="w-full mt-1 border-gray-300 rounded-md shadow-sm row"><div>
                            </div>
                        </div>
                        <input type="hidden" value="{{$from['template'] ?? ''}}" name="content" id="content">
                        <div class="flex float-right gap-4">
                            <x-primary-button class="flex float-right mt-2">Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
