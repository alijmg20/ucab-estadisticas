<nav class="bg-white-100 shadow-lg" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">

        {{-- left nav --}}
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden md:hidden">
            <!-- Mobile menu button-->        
          <button x-on:click="open = true" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.
  
              Heroicon name: outline/bars-3
  
              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
              Icon when menu is open.
  
              Heroicon name: outline/x-mark
  
              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        {{-- center nav --}}
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">

            {{-- logotipo company --}}
          <a href="/" class="flex flex-shrink-0 items-center">
            <img class="block h-8 w-auto lg:hidden" src="{{asset('/img/logos/LogoUCAB.png')}}" alt="Your Company">
            <img class="hidden h-8 w-auto lg:block" src="{{asset('/img/logos/LogoUCAB.png')}}" alt="Your Company">
          </a>

          {{-- center menu --}}
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

              {{-- <a href="#" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Dashboard</a> --}}
  
              {{-- @foreach ($lines as $line) --}}
              {{-- <a href="{{route('projects.index')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{__('projects')}}</a>     --}}
                <a href="{{route('projects.index')}}" class="text-black hover:bg-gray-100 hover:text-black px-3 py-2 rounded-md text-sm font-medium">{{__('Proyectos')}}</a>    
              {{-- @endforeach --}}
                {{-- <div x-data="{ open: false }" class="relative inline-block text-left">
                  <div>
                    <button x-on:click="open = true" type="button" class="inline-flex w-full justify-center rounded-md text-black hover:bg-gray-100 hover:text-black px-3 py-2 rounded-md text-sm font-medium" id="menu-button" aria-expanded="true" aria-haspopup="true">
                      {{__('Lineas de investigacíon')}}
                      <!-- Heroicon name: mini/chevron-down -->
                      <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                      </svg>
                    </button>
                  </div>
                
                  <!--
                    Dropdown menu, show/hide based on menu state.
                
                    Entering: "transition ease-out duration-100"
                      From: "transform opacity-0 scale-95"
                      To: "transform opacity-100 scale-100"
                    Leaving: "transition ease-in duration-75"
                      From: "transform opacity-100 scale-100"
                      To: "transform opacity-0 scale-95"
                  -->
                  <div x-show="open" x-on:click.away="open = false" class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                      @foreach ($lines as $line)
                      <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                      <a href="{{route('lines.show',$line);}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">{{$line->name}}</a>
                      @endforeach
                    </div>
                  </div>
                </div> --}}
                <a href="{{route('lines.index')}}" class="text-black hover:bg-gray-100 hover:text-black px-3 py-2 rounded-md text-sm font-medium">{{__('Lineas de Investigación')}}</a>    
                <a href="{{route('about')}}" class="text-black hover:bg-gray-100 hover:text-black px-3 py-2 rounded-md text-sm font-medium">{{__('Sobre Nosotros')}}</a>    
                <a href="{{route('contact')}}" class="text-black hover:bg-gray-100 hover:text-black px-3 py-2 rounded-md text-sm font-medium">{{__('Contacto')}}</a>    
            </div>
          </div>
        </div>

        @auth
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                {{-- notification button --}}
                {{-- <button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button> --}}
        
                <!-- Profile dropdown -->
                <div class="relative ml-3 " x-data="{ open: false }">
                    <div>
                    <button x-on:click="open = true" type="button" class="flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 " id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full" src="{{auth()->user()->profile_photo_url}}" alt="">
                    </button>
                    </div>
        
                    <!--
                        menu de navegacion
                    -->
                    <div x-show="open" x-on:click.away="open = false" class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <a href="{{route( 'profile.show' )}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">{{__('Perfil')}}</a>
                    @can('admin.home')
                    <a href="{{route( 'admin.home' )}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">{{__('dashboard')}}</a>    
                    @endcan
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2" @click.prevent="$root.submit();">Cerrar sesión</a>
                    </form>
                    </div>
                </div>
            </div>    

        @else
        <a href="{{route( 'login' )}}" class="hidden sm:block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Iniciar sesión</a>    
        <a href="{{route( 'register' )}}" class="hidden sm:block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Registrarse</a>        
        <a href="{{route( 'login' )}}" class="sm:hidden px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0"><i class="fas fa-user"></i></a>        
        @endauth
        {{-- right nav --}}
        
      </div>
    </div>
  
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" x-show="open" id="mobile-menu" x-on:click.away="open=false">
      <div class="space-y-1 px-2 pt-2 pb-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        {{-- <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Dashboard</a> --}}
        {{-- @foreach ($lines as $line) --}}
          <a href="{{route('projects.index')}}" class="text-black hover:bg-gray-100 hover:text-black block px-3 py-2 rounded-md text-base font-medium text-center">{{__('Proyectos')}}</a>
        {{-- @endforeach --}}

        {{-- <div x-data="{ open: false }" class="block px-3 py-2 rounded-md text-base font-medium">
          <div>
            <button x-on:click="open = true" type="button" class="inline-flex w-full justify-center rounded-md text-black hover:bg-gray-100 hover:text-black px-3 py-2 rounded-md text-sm font-medium" id="menu-button" aria-expanded="true" aria-haspopup="true">
              {{__('Lineas de investigacíon')}}
              <!-- Heroicon name: mini/chevron-down -->
              <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        
          <!--
            Dropdown menu, show/hide based on menu state.
        
            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
          <div x-show="open" x-on:click.away="open = false" class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium text-center" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
              @foreach ($lines as $line)
              <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
              <a href="{{route('lines.show',$line);}}" class="text-black hover:bg-gray-100 hover:text-black block px-3 py-2 rounded-md text-base font-medium text-center" role="menuitem" tabindex="-1" id="menu-item-0">{{$line->name}}</a>
              @endforeach
            </div>
          </div>
        </div> --}}
        <a href="{{route('lines.index')}}" class="text-black hover:bg-gray-100 hover:text-black block px-3 py-2 rounded-md text-base font-medium text-center">{{__('Lineas de Investigación')}}</a>
        <a href="{{route('about')}}" class="text-black hover:bg-gray-100 hover:text-black block px-3 py-2 rounded-md text-base font-medium text-center">{{__('Sobre Nosotros')}}</a>
        <a href="{{route('contact')}}" class="text-black hover:bg-gray-100 hover:text-black block px-3 py-2 rounded-md text-base font-medium text-center">{{__('Contacto')}}</a>
      </div>
    </div>
  </nav>