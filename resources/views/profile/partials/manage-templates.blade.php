<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 d-inline-flex">
            {{ __('Manage Templates') }}
            <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new-template')" class="float-right text-3xl text-gray-500 d-inline-flex hover:bg-white hover:text-blue-400 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">+</a>
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Use templates to quickly build your pages from an existing format') }}
        </p>
    </header>
    <div>
        <div class="relative">
            <table class="w-full mt-3 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="float-right px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($templates as $template)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-left text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $template['name'] }}
                            </th>
                            <td class="float-right">
                                <div class="flex self-end justify-end float-right mt-2 text-gray-800">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                                <div>Actions</div>
                                                <div class="ml-1">
                                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('pages.create', ['template_id' => $template['id']])">
                                                {{ __('Page From') }}
                                            </x-dropdown-link>
                                            <hr/>
                                            <form method="post" action="{{ route('templates.destroy', $template['id']) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link
                                                    onclick="this.closest('form').submit();"
                                                >{{ __('Delete') }}</x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create New Template. -->
    <x-modal name="create-new-template" id="create-new-template" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-3">
            <form method="post" action="{{ route('templates.store') }}" id="new_page_form" class="space-y-1">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" class="mb-2 text-lg font-black" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="block w-full mt-1 text-lg" :value="old('name')" required autofocus/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- Template -->
                <div class="items-center d-flex">
                    <div class="w-full">
                        <x-input-label for="title" class="my-4 text-lg font-black" :value="__('Contents')" />
                        <div id="editor" class="w-full mt-1 border-gray-300 rounded-md shadow-sm row"><div>
                    </div>
                </div>
                <input type="hidden" name="template" id="content">
                <div class="flex float-right gap-4 mb-2">
                    <x-primary-button class="flex float-right mt-2">Save</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
