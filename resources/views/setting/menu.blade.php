

<div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
   <a href="/dashboard" class="flex items-center pl-2.5 mb-5">
         <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-7" alt=" Logo" />
         <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Empresa SA de CV</span>
      </a>
            <ul class="pt-4 mt-4 space-y-2">
                <li>
                    <a href="{{route('dashboard')}}"  class="cursor-pointer flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                        <x-heroicon-s-building-office  class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"  />
                        <span class="flex-1 ml-3 whitespace-nowrap">Dashboard</span>
                    </a>
                </li>
            <li>
            <button type="button" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                <x-heroicon-s-archive-box   class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"  />
                   <span class="flex-1 ml-3 text-left whitespace-nowrap">Modulos</span>
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        @forelse ($items as $item=>$value )
                        @if($value['opc']==="1"  )
                        <li>
                            <a href="{{route($value['rute'])}}"  class="cursor-pointer flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                @svg('heroicon-s-'.$value['icon'], 'w-6 h-6', ['class' => 'flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white'])
                                <span class="flex-1 ml-3 whitespace-nowrap"> {{ $value['name'] }}</span>
                            </a>
                        </li>
                        @endif
                    @empty

                    @endforelse

          </ul>
         </li>

    </ul>
        <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
            @if(Auth::user()->getRoleNames()[0]==="Super-Admin"   )
            <li>
                <a href="{{route('setting.index')}}"  class="cursor-pointer flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <x-heroicon-s-cog-6-tooth  class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"  />
                    <span class="flex-1 ml-3 whitespace-nowrap">Setting</span>
                </a>
            </li>
            @endif

            @forelse ($items as $item=>$value )
            @if( $value['opc'] <>"1" )
                    <li>
                        <a href="{{route($value['rute'])}} "  class="cursor-pointer flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                            @svg('heroicon-s-'.$value['icon'], 'w-6 h-6', ['class' => 'flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white'])
                            <span class="flex-1 ml-3 whitespace-nowrap">{{ $value['name'] }}</span>
                        </a>
                    </li>
                    @endif
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
