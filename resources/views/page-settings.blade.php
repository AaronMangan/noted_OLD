<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Page Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Page Settings -->
        <div class="mx-auto mb-6 space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <form method="post" action="{{ route('settings.store', $page->id) }}" id="page-settings-form" class="space-y-0">
                    @csrf
                    <div class="h-full">
                        <div class="m-1">
                            <x-text-input id="private" name="private" type="checkbox" class="inline-block text-lg" :value="old('private')" />
                            <x-input-label for="private" class="inline-block pt-2 mb-2 ml-3 font-bold justify-baseline" :value="__('Private')" />
                            <x-input-label for="private" class="inline-block pt-2 mb-2 ml-3 text-xs text-gray-200 text-md justify-baseline" :value="__('Private pages cannot be shared. If the page is already shared, those users will not be able to view the page until it is not marked as private')" />
                            <x-input-error class="mt-2" :messages="$errors->get('private')" />
                        </div>
                    </div>
                </form>
            </div>
            <x-primary-button type="submit" onclick="document.querySelector('#page-settings-form').submit();" class="flex float-right">Apply</x-primary-button>
        </div>
    </div>
</x-app-layout>
