<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @include('components.search')
            <div class="m-3 bg-white dark:bg-gray-800 sm:rounded-lg">
                @if(count($pages) > 0)
                    @foreach($pages as $page)
                        <div class="flex justify-between w-full mt-3 align-baseline border border-gray-100 rounded-md shadow-sm">
                            <div class="flex w-full px-4 py-2 m-2 text-left text-gray-800">
                                <div class="w-full mt-1 text-gray-700 align-middle col text-clip dark:text-gray-100">
                                    <div class="font-semibold">
                                        <span class="text-clip" onclick='window.location="{{route('pages.show', $page->id)}}"'>{{ $page->title }}</span><span class="text-lg text-red-500">{{ $page->private ? "*" : "" }}</span>
                                    </div>
                                </div>
                                <div class="w-full mt-2 text-xs text-center text-gray-400 flex-inline">{{$page->user->name}}</div>
                            </div>
                            <div class="flex self-end justify-end float-right px-4 py-2 m-2 text-gray-800">
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
                                        <x-dropdown-link :href="route('pages.show', $page->id)">
                                            {{ __('View') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('pages.edit', $page->id)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <hr/>
                                        <form method="post" action="{{ route('pages.destroy', $page->id) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                            >{{ __('Delete') }}</x-dropdown-link>
                                        </form>
                                        <hr/>
                                        <x-dropdown-link x-data="" data-id="{{$page->id}}" x-on:click.prevent="$dispatch('open-modal', 'share-this-page-{{$page->id}}')">Share</x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                        <!-- Share Page -->
                        <x-modal name="share-this-page-{{$page->id}}" id="share-this-page" :show="$errors->shareThisPage->isNotEmpty()" focusable>
                            <div class="p-3">
                                <form method="post" action="{{ route('pages.share', $page->id) }}" id="share_form" class="space-y-1">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <x-input-label for="email" class="mb-2 text-lg font-black" :value="__('Email')" />
                                        <x-text-input id="email" name="email" placeholder="Enter the email of the user to share with..." type="text" class="block w-full mt-1 text-lg" :value="old('email')" required autofocus/>
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                    <div class="flex float-right gap-4 mb-2">
                                        <x-primary-button class="flex float-right mt-2 mb-2">Share</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </x-modal>
                    @endforeach
                @endif

                <!-- Shared Pages -->
                @if(count($shared) > 0)
                    @foreach($shared as $page)
                        <div class="flex justify-between w-full mt-3 align-baseline border border-gray-100 rounded-md shadow-sm bg-gray-50">
                            <div class="flex w-full px-4 py-2 m-2 text-left text-gray-800">
                                <div class="w-full mt-1 text-gray-700 align-middle col text-clip dark:text-gray-100">
                                    <div class="font-semibold"><span class="text-clip" onclick='window.location="{{route('pages.show', $page->id)}}"'>{{ $page->title }}</span></div>
                                </div>
                                <div class="w-full mt-2 text-xs text-center text-gray-400 flex-inline">{{$page->user->name}}</div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if(count($shared) == 0 && count($pages) == 0)
                    <p class="m-4 text-xl text-center text-gray-500">No Results</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
