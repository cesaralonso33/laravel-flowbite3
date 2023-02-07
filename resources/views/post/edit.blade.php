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
        <div class="grid grid-cols-1 gap-4 mb-4">
<div>
<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tab1</button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Tab2</button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Tab3</button>
        </li>
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Tab4</button>
        </li>
    </ul>
</div>
<div id="myTabContent">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
</div>

</div>


</div>
</div>


    {{--  <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
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
    </div> --}}


</form>
<script>
    window.onload = function() {
        document.getElementById("{{$items[0]->name}}").focus();
    }
    </script>
    </x-app-layout>
