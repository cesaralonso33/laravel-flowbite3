<x-app-layout>


    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="relative" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="absolute top-0 right-0 h-16 ">
                <x-primary-button type="submit">Guardar</x-primary-button>
            </div>

                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

                        @forelse ($Itemtabs as $key )
                                    <li class="mr-2" role="presentation">
                                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="tt{{$key['id']}}-tab" data-tabs-target="#tt{{$key['id']}}" type="button" role="tab" aria-controls="tt{{$key['id']}}" aria-selected="false">{{$key['label']}}</button>
                                    </li>
                        @empty

                        @endforelse


                    </ul>
                </div>

            <div id="myTabContent">
                                @forelse ($Itemtabs as $key )
                                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tt{{$key['id']}}"
                                                role="tabpanel" aria-labelledby="tt{{$key['id']}}-tab">


                                                <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
                                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                                        <livewire:label-edit :container="$key['label']" />
                                                    </h5>
                                                    <div class="h-9"></div>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8 w-full">
                                                               @forelse ($key['Items'] as $item)

                                                                                                    <x-OpcSelectInputCrad
                                                                                                            :name="$item['name']"
                                                                                                            :label="$item['label']"
                                                                                                            :required="$item['required']"
                                                                                                            :list="$item['list']"
                                                                                                            :values="$post"
                                                                                                            :type="$item['type']" />

                                                                                @empty
                                                                                @endforelse


                                                                                <input id="id" name="id" type="hidden" value="{{$post->id}}">

                                                                     {{--            <input id="timage" name="timage" type="hidden" value="{{$itemimage}}">
 --}}
                                                    </div>
                                                </div>


                                        </div>
                                @empty

                                @endforelse

            </div>





    </form>



    <script>
      window.onload = function() {
            try {
                document.getElementById(" {{ $Itemtabs[0]['Items'][0]['name']  }}").focus();
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
