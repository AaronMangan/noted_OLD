<x-app-layout>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col space-y-1">
                    <form method="post" action="{{ route('pages.store') }}" class="space-y-1">
                        @csrf
                        <div>
                            <x-input-label for="title" class="mb-2 text-lg font-black" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1 text-lg" :value="old('title')" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="items-center d-flex">
                            <div class="w-full">
                                <x-input-label for="title" class="my-4 text-lg font-black" :value="__('Contents')" />
                                <div id="editor" class="w-full mt-1 border-gray-300 rounded-md shadow-sm row"><div>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            @if (session('status') === 'page-stored')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                        <div class="mt-4 text-right d-inline-flex row">
                            <x-primary-button>Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>