<x-app-layout>



    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="relative" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="absolute top-0 right-0 h-16 w-16 ..."><x-primary-button type="submit">Guardar</x-primary-button></div>

        <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
            <div class="grid grid-cols-1 gap-4 mb-4">
                <div>
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                            data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Tab1</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard" aria-selected="false">Tab2</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                                    aria-controls="settings" aria-selected="false">Tab3</button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                                    aria-controls="contacts" aria-selected="false">Tab4</button>
                            </li>
                        </ul>
                    </div>
                    <div id="myTabContent">
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                   Tab 1
                                </h5>
<div class="h-9"></div>
                                <div class="grid grid-cols-2 gap-4 mb-8 w-full">
                                           @forelse ($items as $item)

                                                                                <x-OpcSelectInputCrad
                                                                                        :name="$item->name"
                                                                                        :label="$item->label"
                                                                                        :required="$item->required"
                                                                                        :list="$item->list"
                                                                                        :values="$post"
                                                                                        :type="$item->type" />

                                                            @empty
                                                            @endforelse


                                                            <input id="id" name="id" type="hidden" value="{{$post->id}}">

                                                            <input id="timage" name="timage" type="hidden" value="{{$itemimage}}">

                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            {{-- <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
     --}}
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">

                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                            aria-labelledby="contacts-tab">

                        </div>
                    </div>

                </div>


            </div>
        </div>



    </form>



    <script>
        window.onload = function() {
            try {
                document.getElementById("{{ empty($items[0]->name) ? '' : $items[0]->name }}").focus();
            } catch (e) {
                logMyErrors(e); // pasa el objeto de la excepción al manejador de errores
            }
        }
    </script>

@section('scriptss')
<script>
    // FilePond.registerPlugin(FilePondPluginImagePreview);
    // Get a reference to the file input element
   // const inputElement = document.querySelector('input[type="file"]');
    const inputElement = document.querySelectorAll('input[type="file"]');
      // create a FilePond instance at the input element location
       const pond = FilePond.create(inputElement, {
        maxFiles: 10,
        allowMultiple:true,
     //   allowBrowse: false,
    });

    // attributes and initial options have been set to pond options
    console.log(pond.name); // 'filepond'
    console.log(pond.maxFiles); // 10
    console.log(pond.required); // true
    console.log(pond.allowMultiple); // true


    FilePond.setOptions({
    server: {
        url: '../../pi/dropzone',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
})


    // Create a FilePond instance
    //const pond = FilePond.create(inputElement);
</script>
@endsection

</x-app-layout>
