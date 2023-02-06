<x-app-layout>

     <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-3 gap-4 mb-4">
           <div class="flex items-center justify-center h-14 rounded ">

        </div>
           <div class="flex items-center justify-center h-14 rounded ">

        </div>
           <div class="flex items-center justify-center h-14 rounded ">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                <!-- drawer init and toggle -->
                <div class="text-center">
@if (Auth::id()===1)
<x-primary-button >
    {{__('Configure Columns')}}
</x-primary-button>


<x-primary-button data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
    {{__('New Colummn')}}
</x-primary-button>

@endif

                 </div>
                </p>


 <!-- drawer component -->
 <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
     <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        {{__('New Colummn')}}</h5>
    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
       <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
       <span class="sr-only">{{__('Close menu')}}</span>
    </button>


    {{-- <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
        Supercharge your hiring by taking advantage of our <a href="#" class="text-blue-600 underline dark:text-blue-500 hover:no-underline">limited-time sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked candidates and the #1 design job board.
    </p> --}}

<form action="{{route('posts.store')}}" method="POST">
@csrf


<div class="mt-4">
    <x-input-label for="name" :value="__('Name')" />

        <x-text-input id="name" class="block mt-1 w-full"
                        type="text"
                        name="name" required
                        />

        <x-input-error :messages="$errors->get('namecolummn')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="label" :value="__('Label')" />

        <x-text-input id="label" class="block mt-1 w-full"
                        type="text"
                        name="label" required
                         />

        <x-input-error :messages="$errors->get('label')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="required" :value="__('Required')" />

        <x-text-input id="required" class="block mt-1 "
                        type="checkbox"
                        name="required"
                         />

        <x-input-error :messages="$errors->get('label')" class="mt-2" />
</div>


                        <div class="mt-4">
                            <x-input-label for="type" :value="__('Type')" />
                            @php
                                $arrayt=['TEXT','INT','BLOB','LIST'];
                            @endphp
                                <x-selected id="type" name="type" :items="$arrayt" required></x-selected>

                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                          </div>


<div class="mt-4">
    <x-input-label for="list" :value="__('List')" />

        <x-text-input id="list" class="block mt-1 w-full"
                        type="text"
                        name="list" placeholder="'example1','example2'"                         />

        <x-input-error :messages="$errors->get('list')" class="mt-2" />

</div>

            <div class="h-6"></div>

            <div class="grid grid-cols-2 gap-4">
                  <x-primary-button class="text-center">{{__('Save')}}</x-primary-button>
            </div>
    </form>
 </div>

           </div>
        </div>
        <div class=" items-center justify-center  mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <livewire:pos-table />
        </div>

        </div>
     </div>


    </x-app-layout>
