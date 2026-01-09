@extends('layouts.akademik')

@section('title', 'Edit Data Mahasiswa')

@section('content')

<div class="max-w-4xl mx-auto">
    
    <div class="mb-6">
        <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium transition-colors gap-2 group">
            <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center shadow-sm group-hover:border-blue-300 transition-all">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </div>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-8 py-5 flex items-center justify-between">
            <div>
                <h3 class="text-white font-bold text-lg flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square"></i> Perbarui Data
                </h3>
                <p class="text-yellow-50 text-xs mt-1 opacity-90">
                    Sedang mengedit data: <span class="font-bold underline">{{ $mahasiswa->nama }}</span>
                </p>
            </div>
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center text-white backdrop-blur-sm">
                <i class="fa-solid fa-user-pen"></i>
            </div>
        </div>

        <div class="p-8">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Nomor Induk (NIM)</label>
                        <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" placeholder="Contoh: 2024001"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all @error('nim') border-red-500 @enderror">
                        @error('nim') 
                            <p class="text-red-500 text-xs mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> 
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Tahun Angkatan</label>
                        <select name="angkatan" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all cursor-pointer @error('angkatan') border-red-500 @enderror">
                            <option value="">Pilih Tahun</option>
                            @for($i = date('Y'); $i >= 2018; $i--)
                                <option value="{{ $i }}" {{ old('angkatan', $mahasiswa->angkatan) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error('angkatan') 
                            <p class="text-red-500 text-xs mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> 
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all @error('nama') border-red-500 @enderror">
                        @error('nama') 
                            <p class="text-red-500 text-xs mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> 
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Program Studi / Jurusan</label>
                        <div class="relative">
                            <select name="jurusan" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all appearance-none cursor-pointer @error('jurusan') border-red-500 @enderror">
                                <option value="">Pilih Jurusan</option>
                                @php
                                    $jurusans = ['Teknik Informatika', 'Sistem Informasi', 'Manajemen Bisnis', 'Desain Komunikasi Visual'];
                                @endphp
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan }}" {{ old('jurusan', $mahasiswa->jurusan) == $jurusan ? 'selected' : '' }}>
                                        {{ $jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('jurusan') 
                            <p class="text-red-500 text-xs mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> 
                        @enderror
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                    <button type="submit" class="bg-gray-900 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-gray-300 hover:bg-gray-800 hover:shadow-xl active:scale-95 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('mahasiswa.index') }}" class="px-6 py-3 rounded-xl font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection