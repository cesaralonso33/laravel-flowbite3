<x-app-layout>

     <div class="p-4   border-gray-200 border-dashed  dark:border-gray-700">

        <div class="grid grid-cols-3 gap-4 mb-4">
           <div class="flex items-center justify-center h-14 rounded ">
              <p class="text-2xl text-gray-400 dark:text-gray-500">+  </p>
           </div>
           <div class="flex items-center justify-center h-14 rounded ">
              <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
           </div>
           <div class="flex items-center justify-center h-14 rounded ">
              <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
           </div>
        </div>


        <div class="grid grid-cols-2 gap-2 mb-2">
            <div class="flex items-center justify-center   rounded ">
                <livewire:show-module />
            </div>

            <div class="flex items-center justify-center   rounded ">
               <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
         </div>


        <div class="flex items-center justify-center h-auto mb-4 rounded bg-gray-50 dark:bg-gray-800">

          <div class="w-5/6 lg:w-full xl:w-full ">

            <livewire:show-module />
          </div>


        </div>



     </div>


    </x-app-layout>
