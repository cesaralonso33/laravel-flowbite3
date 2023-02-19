<x-app-layout>

    <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
        @include('post.FormNewColumn')


        <div class=" items-center justify-center  mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <livewire:pos-table />
        </div>

    </div>
    </div>

</x-app-layout>
