<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie App</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="font-sans bg-gray-900 text-white">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <nav class="border-b border-gray-800">
        <div class="container  mx-auto flex flex-col md:flex-row  items-center justify-between px-4 py-6">
                <ul class="flex items-center flex-col md:flex-row">
                    <li>
                        <a href="/" class="text-white flex ">
                            <svg class="fill-current mr-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 23h-24v-21h24v21zm-20-1v-4h-3v4h3zm15 0v-19h-14v19h14zm4 0v-4h-3v4h3zm-6-9.5l-9 5v-10l9 5zm3 .5v4h3v-4h-3zm-16 4v-4h-3v4h3zm5-1.2l5.941-3.3-5.941-3.3v6.6zm11-7.8v4h3v-4h-3zm-16 4v-4h-3v4h3zm16-9v4h3v-4h-3zm-16 4v-4h-3v4h3z"/></svg>
                        Movies App</a>
                    </li>
                    <li class="md:ml-16 mt-3 md:mt-0">
                        <a href="" class="hover:text-gray-300">Movies</a>
                    </li>
                    {{-- <li class="md:ml-6 mt-3 md:mt-0">
                        <a href="" class="hover:text-gray-300">Genre</a>
                    </li> --}}  
                    {{-- <li class="md:ml-6 mt-3 md:mt-0">
                        <a href="" class="hover:text-gray-300">Actor</a>
                    </li> --}}
                    @auth
                   @if (Auth::user()->role == 'admin')
                    <li class="md:ml-6 mt-3 md:mt-0">
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-500 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Add movie <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                          </svg></button>@endif @endauth
                                    <!-- Dropdown menu -->
                                    <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                          <li>
                                            <a href="{{ route('movies.create') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add</a>
                                          </li>
                                          <li>
                                            <a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Table</a>
                                          </li>
                                        </ul>
                                    </div>
                                </li>
                    </li>
                </ul>
                <div class="flex flex-col md:flex-row items-center">
                    <div class="relative mt-3 md:mt-0">
                        <form action="{{ route('movies.search') }}" method="GET"> <!-- Pastikan method GET -->
                            <input type="text" name="query" id="search" class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:shadow-outline" placeholder="Search" required> <!-- Gunakan name="query" untuk pengiriman data -->
                            <button type="submit" class="hidden">Search</button> <!-- Tambahkan tombol submit, meskipun tersembunyi -->
                        </form>
                        
                        <div class="absolute top-2 left-2">
                            <svg class="fill-current" clip-rule="evenodd" width="16px" height="16px" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m15.97 17.031c-1.479 1.238-3.384 1.985-5.461 1.985-4.697 0-8.509-3.812-8.509-8.508s3.812-8.508 8.509-8.508c4.695 0 8.508 3.812 8.508 8.508 0 2.078-.747 3.984-1.985 5.461l4.749 4.75c.146.146.219.338.219.531 0 .587-.537.75-.75.75-.192 0-.384-.073-.531-.22zm-5.461-13.53c-3.868 0-7.007 3.14-7.007 7.007s3.139 7.007 7.007 7.007c3.866 0 7.007-3.14 7.007-7.007s-3.141-7.007-7.007-7.007z" fill-rule="nonzero"/></svg>
                        </div>
                    </div>
                    <div class="md:ml-4 mt-3 md:mt-0">
                   
                    <div class="relative inline-block text-left">
                        <div>
                            <!-- Dropdown menu -->
                            <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md" id="menu-button" aria-expanded="false" aria-haspopup="true">
                        <img src="{{ asset('img/profile.png') }}" alt="avatar" class="rounded-full w-8 h-8">
                        <i>&sbquo;;</i>
                            </button>
                        </div>
                      
                        <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                @guest
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-800 hover:text-white" role="menuitem" tabindex="-1" id="menu-item-0">Login</a>
                                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-800 hover:text-white" role="menuitem" tabindex="-1" id="menu-item-1">Register</a> @endguest
                                @auth
                                <form method="get" action="{{ route('logout') }}" role="none">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-800 hover:text-white" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
                                </form>
                                 @endif
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        // Mendapatkan elemen tombol dan dropdown
                        const menuButton = document.getElementById('menu-button');
                        const dropdownMenu = document.getElementById('dropdown-menu');
                    
                        // Fungsi untuk toggle dropdown
                        menuButton.addEventListener('click', function () {
                            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true' || false;
                            menuButton.setAttribute('aria-expanded', !isExpanded);
                            dropdownMenu.classList.toggle('hidden');
                        });
                    
                        // Menutup dropdown jika klik di luar dropdown
                        document.addEventListener('click', function (event) {
                            if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                                dropdownMenu.classList.add('hidden');
                                menuButton.setAttribute('aria-expanded', 'false');
                            }
                        });
                        
                    </script>
                    
                      
                </div>
                </div>
                
        </div>
    </nav>
    @yield('content')
</body>
</html>