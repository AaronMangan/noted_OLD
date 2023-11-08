<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 d-inline-flex">
            {{ __('Manage Tags') }}
            <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new-tag')" class="float-right text-3xl text-gray-500 d-inline-flex hover:bg-white hover:text-blue-400 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">+</a>
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Tags help you to label and organise your pages, they can also be used to search for content quickly. Add, Edit or Delete your tags here.') }}
        </p>
    </header>
    <div>
        <x-noted-table :tableData="$tags" type="table-auto" class="w-100"></x-noted-table>
    </div>
    <x-modal name="create-new-tag" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-3">
            <form method="post" action="{{ route('tags.store') }}" class="mt-6 space-y-6">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Tag Name')" />
                    <x-text-input id="name" name="name" type="text" class="block w-full mt-1" autocomplete="name" />
                    <x-input-error :messages="$errors->updatePassword->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" name="description" type="text" class="block w-full mt-1" autocomplete="description" />
                    <x-input-error :messages="$errors->updatePassword->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>

    </x-modal>
</section>
