<x-app-layout>

    <form action="{{route('roles.update',$role->id)}}" method="POST">
        @csrf
        @method('PUT')

     <div class="p-4  border-gray-200   rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-3 gap-4 mb-4">
           <div class="flex items-center justify-center h-14 rounded ">
                <p class="text-2xl text-gray-400 dark:text-gray-500">{{ ($role->name)}}</p>
           </div>
           <div class="flex items-center justify-center h-14 rounded ">

           </div>
           <div class="flex items-center justify-center h-14 rounded ">
                     <x-primary-button type="submit">Guardar</x-primary-button>
           </div>
        </div>
        <div class="flex items-center justify-center h-auto mb-4 rounded bg-gray-50 dark:bg-gray-800">

          <div class="w-5/6 lg:w-full xl:w-full ">


<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{strtoupper(__('Module'))}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('View')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('Create')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('Edit')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('Delete')}}
                </th>
            </tr>
        </thead>
        <tbody>

            @forelse ( $multiplied as $item=>$value)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{strtoupper(__($value['name']))}}
                 </th>
                <td class="px-6 py-4">
                     <x-text-input id="v_{{$value['id']}}" value="view {{ $value['name']}}" class="block mt-1 " type="checkbox" name="v_{{$value['id']}}" :checked="$value['data']['view']" />
                </td>
                <td class="px-6 py-4">
                    <x-text-input id="c_{{$value['id']}}" value="create {{ $value['name']}}" class="block mt-1 " type="checkbox" name="c_{{$value['id']}}"  :checked="$value['data']['create']"/>
                </td>
                <td class="px-6 py-4">
                    <x-text-input id="e_{{$value['id']}}" value="edit {{ $value['name']}}" class="block mt-1 " type="checkbox" name="e_{{$value['id']}}"  :checked="$value['data']['edit']"/>
                </td>
                <td class="px-6 py-4">
                    <x-text-input id="d_{{$value['id']}}" value="delete {{ $value['name']}}" class="block mt-1 " type="checkbox" name="d_{{$value['id']}}"  :checked="$value['data']['delete']" />
                </td>
            </tr>

            @empty

            @endforelse

        </tbody>
    </table>
</div>

          </div>


        </div>


     </div>


    </form>

    </x-app-layout>
