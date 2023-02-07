<x-app-layout>



     <div class="p-4   border-gray-200   rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-3 gap-4 mb-4">
           <div class="flex items-center justify-center h-14 rounded ">
{{-- {{ (Auth::user()->getPermissionsViaRoles()) }}
{{ (Auth::user()->getAllPermissions()) }}
 --}}

           </div>
           <div class="flex items-center justify-center h-14 rounded ">

           </div>
           <div class="flex items-center justify-center h-14 rounded ">
              <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
           </div>
        </div>
        <div class="flex items-center justify-center h-auto mb-4 rounded bg-gray-50 dark:bg-gray-800">

          <div class="w-5/6 lg:w-full xl:w-full ">
              <livewire:show-role />


{{--
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('Roles')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('Permissions')}}
                </th>

            </tr>
        </thead>
        <tbody>
            @forelse ( $itemstable as $key=>$value)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ $value['id_rol'] }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a>


                </th>
                <td class="px-6 py-4">
                    {{ ($value['nombre_rol']) }}
                </td>
                <td class="px-6 py-4">
                    @forelse ( $value['Permission'] as $key1=>$value1 )
                    <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span class="flex w-2.5 h-2.5 bg-blue-600 rounded-full mr-1.5 flex-shrink-0"></span> {{($value1->name)}}</span>

                    @empty

                    @endforelse
                </td>

            </tr>

            @empty

            @endforelse

        </tbody>
    </table>
</div>
 --}}
          </div>


        </div>

     </div>


    </x-app-layout>
