<x-app-layout>



    <div class="p-2  border-gray-200   rounded-lg dark:border-gray-700">
@include('{module}::FormNewColumn')
        <div class=" items-center justify-center  mb-4 rounded bg-gray-50 dark:bg-gray-800">

            <livewire:{module}::grid />
        </div>

    </div>
    </div>

</x-app-layout>
