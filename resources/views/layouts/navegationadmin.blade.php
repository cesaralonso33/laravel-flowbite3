@php
use Illuminate\Support\Facades\Cache;
$valueCache = Cache::get('CacheModule');
$collection = collect($valueCache);


 $linkmenu=  array(
                    array("title"=>"Dashboard", "route"=>"dashboard",'icon'=>1)
                );

if(auth()->user()->hasAnyPermission('view Users') and $collection->contains('name', 'Users') ){
    array_push($linkmenu, array("title"=>"Users", "route"=>"users.index",'icon'=>5));
}

if(auth()->user()->hasAnyPermission('view Clients') and $collection->contains('name', 'Clients') ){
    array_push($linkmenu, array("title"=>"Clients", "route"=>"app.clients.index",'icon'=>8));
}

if(auth()->user()->hasAnyPermission('view Providers') and $collection->contains('name', 'Providers') ){
    array_push($linkmenu, array("title"=>"Providers", "route"=>"users.index",'icon'=>7));
}

if(auth()->user()->hasAnyPermission('view Products') and $collection->contains('name', 'Products') ){
    array_push($linkmenu, array("title"=>"Products", "route"=>"users.index",'icon'=>9));
}

if(auth()->user()->hasAnyPermission('view Posts')  and $collection->contains('name', 'Posts')  ){
    array_push($linkmenu, array("title"=>"Posts", "route"=>"posts.index",'icon'=>10));
}

$defaultlist=  array();


if(Auth::user()->getRoleNames()[0]==="Super-Admin"   ){
    array_push($defaultlist, array("title"=>"Setting", "route"=>"setting.index",'icon'=>6));
}

if(auth()->user()->hasAnyPermission('view Permissions') and $collection->contains('name', 'Permissions') ){
    array_push($defaultlist,  array("title"=>"Permissions", "route"=>"permissions.index",'icon'=>2));
}

if(auth()->user()->hasAnyPermission('view Roles') and $collection->contains('name', 'Roles') ){
    array_push($defaultlist,  array("title"=>"Roles", "route"=>"roles.index",'icon'=>3));
}


if(auth()->user()->hasAnyPermission('view Profile') and $collection->contains('name', 'Profile') ){
    array_push($defaultlist, array("title"=>"Profile", "route"=>"profile.edit",'icon'=>4));
}



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
