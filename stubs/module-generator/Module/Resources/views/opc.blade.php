<div class="flex flex-row-reverse">

    @if (Auth::id() === 1)
        <div class="mr-4 ">
            <x-secondary-button data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                data-drawer-placement="right" aria-controls="drawer-right-example">
                <x-heroicon-o-document-plus class="w-7 h-7 text-gray-500 mr-3" /> {{ __('New Colummn') }}
            </x-secondary-button>
        </div>
    @endif


@can('create {Module}')
    <div class="mr-4 ">
        <x-secondary-button data-drawer-target="drawer-right-newrow" data-drawer-show="drawer-right-newrow"
            data-drawer-placement="right" aria-controls="drawer-right-newrow">
            <x-heroicon-o-document-plus class="w-7 h-7 text-gray-500 mr-3" />
        </x-secondary-button>
    </div>
@endcan
</div>

<!-- drawer component -->
<div id="drawer-right-newrow"
    class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-3/4 dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-right-label">
    <h5 id="drawer-right-label"
        class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
            class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>Nuevo</h5>
    <button type="button" data-drawer-hide="drawer-right-newrow" aria-controls="drawer-right-newrow"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>

    <div>

        <form action="{{ route('app.{module}.store2') }}" method="POST" class="relative" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="absolute top-0 right-0 h-16 ">
                <x-primary-button type="submit">Guardar</x-primary-button>
            </div>

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                    data-tabs-toggle="#myTabContent" role="tablist">

                    @forelse ($Itemtabs as $key)
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="tt{{ $key['id'] }}-tab"
                                data-tabs-target="#tt{{ $key['id'] }}" type="button" role="tab"
                                aria-controls="tt{{ $key['id'] }}" aria-selected="false">{{ $key['label'] }}</button>
                        </li>
                    @empty
                    @endforelse


                </ul>
            </div>

            <div id="myTabContent">
                @forelse ($Itemtabs as $key )
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tt{{ $key['id'] }}"
                        role="tabpanel" aria-labelledby="tt{{ $key['id'] }}-tab">


                        <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
                            <h3 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                <livewire:label-edit :container="$key['label']" />
                            </h3>
                            <div class="h-9"></div>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8 w-full">
                                @forelse ($key['Items'] as $item)
                                    <x-OpcSelectInputCrad :name="$item['name']" :label="$item['label']" :required="$item['required']"
                                        :list="$item['list']" :values="''" :type="$item['type']" :listable="$item['list_table']"  :block="$item['block']" />
                                @empty
                                @endforelse

                            </div>
                        </div>


                    </div>
                @empty

                @endforelse

            </div>
        </form>
    </div>
</div>



@if (Auth::id() === 1)
    <!-- drawer component -->
    <div id="drawer-right-example"
        class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-right-label">
        <h5 id="drawer-right-label"
            class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ __('New Colummn') }}
        </h5>
        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('Close menu') }}</span>
        </button>

        <form action="{{ route('app.{module}.store') }}" method="POST">
            @csrf

            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="label" :value="__('Label')" />
                <x-text-input id="label" class="block mt-1 w-full" type="text" name="label" required />
                <x-input-error :messages="$errors->get('label')" class="mt-2" />
            </div>




            <div class=" mt-4">
                <x-toggle-crad id="required" :name="'required'" :labelc="__('Required')" />
                <x-input-error :messages="$errors->get('required')" class="mt-2" />
            </div>

            <div class=" mt-4">
                <x-toggle-crad id="hiddentable" :name="'hiddentable'" :labelc="__('Hidden')" />
                <x-input-error :messages="$errors->get('hiddentable')" class="mt-2" />
            </div>
            <div class=" mt-4">
                <x-toggle-crad id="block" :name="'block'" :labelc="__('Block')" />
                <x-input-error :messages="$errors->get('block')" class="mt-2" />
            </div>



            <div class="mt-4">
                <x-input-label for="type" :value="__('Type')" />
                <x-selected id="type" name="type" :items="$arrayt" required></x-selected>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="list" :value="__('List')" />
                <x-text-input id="list" class="block mt-1 w-full" type="text" name="list"
                    placeholder="'example1','example2'" />
                <x-input-error :messages="$errors->get('list')" class="mt-2" />
            </div>

            <div class="h-4"></div>

            <HR />


            <div id="accordion-collapse" data-accordion="collapse">


                <h2 id="accordion-collapse-heading-2" <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                    data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                    aria-controls="accordion-collapse-body-2">
                    <span>LIST TABLE</span>
                    <svg data-accordion-icon class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
                    <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700">

                        <div class="mt-4">
                            <x-input-label for="listable" :value="__('Name')" />
                            <x-text-input id="listable" class="block mt-1 w-full" type="text" name="listable" />
                            <x-input-error :messages="$errors->get('listable')" class="mt-2" />
                        </div>


                    </div>
                </div>
            </div>






            <div class="h-6"></div>

            <div class="grid grid-cols-2 gap-4">
                <x-primary-button class="text-center">{{ __('Save') }}</x-primary-button>
            </div>

        </form>

    </div>
@endif
