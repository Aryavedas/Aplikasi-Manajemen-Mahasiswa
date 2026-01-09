@extends('layouts.akademik')

@section('title', 'Data Akademik')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    
    <div class="px-8 py-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Mahasiswa</h3>
            <p class="text-gray-500 text-xs mt-1">Mengelola data seluruh angkatan</p>
        </div>
        
        <div class="flex gap-3">
            <a href="{{ route('mahasiswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-100 transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Baru
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                    <th class="px-8 py-4">Informasi Mahasiswa</th>
                    <th class="px-6 py-4">Jurusan</th>
                    <th class="px-6 py-4 text-center">Angkatan</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse ($mahasiswas as $mhs)
                <tr class="hover:bg-gray-50/80 transition-colors group">
                    <td class="px-8 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs uppercase">
                                {{ substr($mhs->nama, 0, 2) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">{{ $mhs->nama }}</h4>
                                <p class="text-xs text-gray-400 font-mono mt-0.5">NIM: {{ $mhs->nim }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $mhs->jurusan }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center text-gray-600 font-semibold">
                        {{ $mhs->angkatan }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-yellow-50 hover:text-yellow-600 transition-all border border-transparent hover:border-yellow-200">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            
                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $mhs->nama }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-600 transition-all border border-transparent hover:border-red-200">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <i class="fa-regular fa-folder-open text-4xl mb-3 opacity-50"></i>
                            <p class="text-sm">Belum ada data mahasiswa.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/30">
        {{ $mahasiswas->links() }}
    </div>
</div>

@endsection