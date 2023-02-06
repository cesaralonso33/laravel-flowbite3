@php

    $linkmenu=  array(
                    array("title"=>"Dashboard", "route"=>"dashboard",'icon'=>1)
                );

if(auth()->user()->hasAnyPermission('view users')){
    array_push($linkmenu, array("title"=>"Users", "route"=>"users.index",'icon'=>5));
}

if(auth()->user()->hasAnyPermission('view client')){
    array_push($linkmenu, array("title"=>"Clients", "route"=>"users.index",'icon'=>8));
}

if(auth()->user()->hasAnyPermission('view provider')){
    array_push($linkmenu, array("title"=>"Providers", "route"=>"users.index",'icon'=>7));
}

if(auth()->user()->hasAnyPermission('view product')){
    array_push($linkmenu, array("title"=>"Products", "route"=>"users.index",'icon'=>9));
}

if(auth()->user()->hasAnyPermission('view post')){
    array_push($linkmenu, array("title"=>"Posts", "route"=>"posts.index",'icon'=>10));
}
    $defaultlist=  array(
                  //  array("title"=>"Setting", "route"=>"setting.index",'icon'=>6),
                  //  array("title"=>"Permissions", "route"=>"permissions.index",'icon'=>2),
                   // array("title"=>"Roles", "route"=>"roles.index",'icon'=>3),
                //    array("title"=>"Profile", "route"=>"profile.edit",'icon'=>4)
                );


if(Auth::user()->getRoleNames()[0]==="Super-Admin"){
    array_push($defaultlist, array("title"=>"Setting", "route"=>"setting.index",'icon'=>6));
}

if(auth()->user()->hasAnyPermission('view permissions')){
    array_push($defaultlist,  array("title"=>"Permissions", "route"=>"permissions.index",'icon'=>2));
}

if(auth()->user()->hasAnyPermission('view roles')){
    array_push($defaultlist,  array("title"=>"Roles", "route"=>"roles.index",'icon'=>3));
}


if(auth()->user()->hasAnyPermission('view profile')){
    array_push($defaultlist, array("title"=>"Profile", "route"=>"profile.edit",'icon'=>4));
}
               // $users = Auth::user()->givePermissionTo('edit articles');
            //  echo (auth()->user()->getPermissionsViaRoles());
             // echo( auth()->user()->hasPermissionTo('edit articles'))
         //    echo( dd(auth()->user()->hasAnyPermission('view profile')))



@endphp

<div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <ul class="space-y-2">
        @forelse ( $linkmenu as $key)
        <li>
            <x-crad-linkbar :href="route($key['route'])" > <x-listsvg :valor="$key['icon']"/> <span class="ml-3">{{  __($key['title'])  }}</span> </x-crad-linkbar>
        </li>
        @empty

        @endforelse
    </ul>

    <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
        @forelse ( $defaultlist as $key)
        <li>
            <x-crad-linkbar :href="route($key['route'])" > <x-listsvg :valor="$key['icon']"/> <span class="ml-3">{{ __($key['title']) }}  </span> </x-crad-linkbar>
        </li>
        @empty

        @endforelse
       <li>
      {{--   <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
           <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
           <span class="flex-1 ml-3 whitespace-nowrap"> {{ __('Users') }}  </span>
        </a>
     </li>
       <li>
          <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"   viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
             >
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>

             <span class="ml-3">{{ __('Setting') }}</span>
          </a>
       </li>
       <li>
        <x-crad-linkbar :href="route('profile.edit')">
            <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path></svg>
            <span class="ml-3">{{ __('Perfile') }}</span>

        </x-crad-linkbar>

       </li> --}}
       <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

          <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
            class="cursor-pointer flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <x-heroicon-s-rocket-launch class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"  />

              <span class="flex-1 ml-3 whitespace-nowrap"> {{ __('Log Out') }}</span>
          </a>
        </form>
       </li>
    </ul>
 </div>
