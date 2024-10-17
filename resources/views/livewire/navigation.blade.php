<nav class="bg-white border-gray-200 dark:bg-gray-900" x-data="{ openMenu: false, openUserMenu: false }">
    <div class="max-w-screen-xl mx-auto p-4">
        <!-- Contenedor superior: Logo y usuario en la misma línea -->
        <div class="flex items-center justify-between flex-wrap">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{Storage::url('CoreImages/logo_SI.jpeg')}}" class="h-12" alt="Logo" />
                <span class="self-center text-1xl font-semibold whitespace-nowrap dark:text-white">Stock Inteligente</span>
            </a>

            <!-- Botón de usuario y menú hamburguesa -->
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                @auth
                <div>
                    <button x-on:click="openUserMenu = !openUserMenu" type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="{{auth()->user()->profile_photo_url}}" alt="user photo">
                    </button>

                    <!-- Dropdown de usuario -->
                    <div x-show="openUserMenu" x-on:click.away="openUserMenu = false" class="z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{route('profile.show')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Tu Perfil</a>
                                @role('Admin')
                                <a href="{{route('admin.home')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Panel Administrativo</a>
                                @endrole
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                <a href="{{route('login')}}" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Ingresar</a>
                <a href="{{route('register')}}" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Registrarse</a>
                @endauth

                <!-- Botón de hamburguesa para móviles -->
                <button x-on:click="openMenu = !openMenu" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menú colapsable para móviles -->
        <div x-show="openMenu" class="w-full md:hidden mt-4">
            <ul class="flex flex-col space-y-2 font-medium p-4 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                @foreach($categories as $category)
                @if($category->name == "Stock_interna")
                @role('Admin')
                <li>
                    <a href="{{route('posts.category',$category)}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white">
                        {{$category->name}}
                    </a>
                </li>
                @endrole
                @endif
                <li>
                    <a href="{{route('posts.category',$category)}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white">
                        {{$category->name}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Menú visible en pantallas grandes -->
        <div class="hidden md:flex md:justify-center mt-4">
            <ul class="flex flex-wrap justify-center md:flex-row md:space-x-8 font-medium p-4 md:p-0 border border-gray-100 rounded-lg bg-gray-50 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                @foreach($categories as $category)
                <li>
                    <a href="{{route('posts.category',$category)}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                        {{$category->name}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>