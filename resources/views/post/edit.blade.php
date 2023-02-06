<x-app-layout>
    <form action="{{route('posts.update',$post->id)}}" method="POST">
@csrf
@method('PUT')
        <div class="p-4   border-gray-200 rounded-lg dark:border-gray-700">
            <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-10 rounded ">
            </div>
            <div class="flex items-center justify-center h-10 rounded ">
            </div>
            <div class="flex items-center justify-center h-10 rounded ">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <x-primary-button type="submit">Guardar</x-primary-button>
                </p>
            </div>
        </div>
     </div>


     <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-3 gap-4 mb-4">
           <div class=" items-center justify-center  rounded bg-gray-50 dark:bg-gray-800">
              @forelse ($items as $item   )

                    <x-OpcSelectInputCrad :name="$item->name" :label="$item ->label" :required="$item->required" :list="$item->list" :values="$post" />

              @empty
              @endforelse
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500"></p>
            </div>
           <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
               <p class="text-2xl text-gray-400 dark:text-gray-500"></p>
            </div>
        </div>
    </div>


</form>
<script>
    window.onload = function() {
        document.getElementById("{{$items[0]->name}}").focus();
    }
    </script>
    </x-app-layout>
