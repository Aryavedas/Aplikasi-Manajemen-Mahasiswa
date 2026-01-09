<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .active-nav { background-color: rgba(255, 255, 255, 0.1); border-left: 4px solid #60a5fa; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

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
                
                <a href="{{ route('mahasiswa.create') }}" 
                   class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('mahasiswa.create') ? 'bg-gray-800 text-white border-l-4 border-blue-500' : '' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                    <span class="font-medium">Dashboard & Input</span>
                </a>

                <a href="{{ route('mahasiswa.index') }}" 
                   class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('mahasiswa.index') ? 'bg-gray-800 text-white border-l-4 border-blue-500' : '' }}">
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    <span class="font-medium">Data Mahasiswa</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-700">
                <button class="flex items-center gap-3 text-sm text-gray-400 hover:text-white transition-colors w-full">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout System</span>
                </button>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10">
                <h2 class="text-xl font-bold text-gray-700">
                    @yield('title', 'Overview')
                </h2>

                <div class="flex items-center gap-6">
                    <button class="relative text-gray-400 hover:text-gray-600">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    
                    <div class="flex items-center gap-3 pl-6 border-l border-gray-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-700">Administrator</p>
                            <p class="text-xs text-gray-500">Bagian Akademik</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 p-[2px]">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=fff&color=000" alt="User" class="rounded-full">
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
                @if ($message = Session::get('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <p class="text-sm text-green-700 font-medium">{{ $message }}</p>
                    </div>
                </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>