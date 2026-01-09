<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Informasi Akademik') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Menggunakan Vite bawaan Breeze untuk Alpine.js (untuk dropdown) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Fallback Tailwind CDN jika Vite belum di-build, hapus jika sudah production --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Style untuk transisi dropdown Alpine.js */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-[#0f172a] text-white flex flex-col shadow-2xl z-20">
            <div class="h-20 flex items-center gap-3 px-6 border-b border-gray-700">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-xl shadow-lg shadow-blue-500/50">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg tracking-wide">SiAkad</h1>
                    <p class="text-xs text-gray-400">Universitas Unggul</p>
                </div>
            </div>

            <nav class="flex-1 py-6 space-y-2 px-3">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Main Menu</p>
                
                {{-- Menu Dashboard --}}
                <a href="{{ route('mahasiswa.create') }}" 
                   class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('mahasiswa.create') ? 'bg-gray-800 text-white border-l-4 border-blue-500' : '' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                    <span class="font-medium">Dashboard & Input</span>
                </a>

                {{-- Menu Data Mahasiswa --}}
                <a href="{{ route('mahasiswa.index') }}" 
                   class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('mahasiswa.index') ? 'bg-gray-800 text-white border-l-4 border-blue-500' : '' }}">
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    <span class="font-medium">Data Mahasiswa</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 text-sm text-gray-400 hover:text-red-400 transition-colors w-full group">
                        <i class="fa-solid fa-right-from-bracket group-hover:rotate-180 transition-transform duration-300"></i>
                        <span>Logout System</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10">
                <h2 class="text-xl font-bold text-gray-700">
                    @yield('title', 'Overview')
                </h2>

                <div class="flex items-center gap-6">
                    <button class="relative text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    
                    <div class="relative pl-6 border-l border-gray-200" x-data="{ open: false }">
                        
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                            <div class="text-right hidden sm:block">
                                {{-- Nama User Dinamis dari Database --}}
                                <p class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition-colors">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 p-[2px] shadow-sm group-hover:shadow-md transition-all">
                                {{-- Avatar Dinamis Berdasarkan Nama --}}
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=000&bold=true" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="rounded-full w-full h-full object-cover">
                            </div>
                            <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                        </button>

                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-4 w-48 bg-white rounded-xl shadow-xl shadow-blue-100 border border-gray-100 py-2 origin-top-right z-50"
                             style="display: none;">
                            
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                <i class="fa-regular fa-user mr-2"></i> Profile
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Log Out
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
                @if ($message = Session::get('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-center justify-between shadow-sm animate-fade-in-down">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <p class="text-sm text-green-700 font-medium">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-green-600">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>