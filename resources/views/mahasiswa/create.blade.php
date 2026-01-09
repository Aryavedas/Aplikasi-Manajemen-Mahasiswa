@extends('layouts.akademik')

@section('title', 'Dashboard & Input')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex items-center justify-between">
                <h3 class="text-white font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Registrasi Mahasiswa Baru
                </h3>
            </div>
            
            <div class="p-8">
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Nomor Induk (NIM)</label>
                            <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 2024001"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all @error('nim') border-red-500 @enderror">
                            @error('nim') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Tahun Angkatan</label>
                            <select name="angkatan" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white @error('angkatan') border-red-500 @enderror">
                                <option value="">Pilih Tahun</option>
                                @for($i = date('Y'); $i >= 2018; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                             @error('angkatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap mahasiswa"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all @error('nama') border-red-500 @enderror">
                             @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Program Studi / Jurusan</label>
                            <select name="jurusan" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white @error('jurusan') border-red-500 @enderror">
                                <option value="">Pilih Jurusan</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                                <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                            </select>
                             @error('jurusan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-xl transition-all flex items-center gap-2">
                            <i class="fa-regular fa-floppy-disk"></i> Simpan Data
                        </button>
                        <button type="reset" class="text-gray-500 font-semibold py-3 px-6 hover:text-gray-700 transition-colors">
                            Reset Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
            
            <div class="relative z-10">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                    <i class="fa-solid fa-users-line"></i>
                </div>
                <p class="text-gray-500 text-sm font-medium">Total Mahasiswa Terdaftar</p>
                {{-- Mengambil data count langsung dari Model untuk dashboard --}}
                <h3 class="text-4xl font-extrabold text-gray-800 mt-2">{{ \App\Models\Mahasiswa::count() }}</h3>
                <p class="text-xs text-green-500 mt-2 font-semibold flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> Data Realtime
                </p>
            </div>
        </div>

        <div class="bg-indigo-900 text-white p-6 rounded-2xl shadow-lg shadow-indigo-200 relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="font-bold text-lg mb-2">Panduan Admin</h4>
                <p class="text-indigo-200 text-sm leading-relaxed mb-4">
                    Pastikan NIM bersifat unik. Data yang sudah dihapus tidak dapat dikembalikan.
                </p>
                <a href="{{ route('mahasiswa.index') }}" class="inline-block text-xs font-bold bg-white/20 hover:bg-white/30 py-2 px-4 rounded-lg backdrop-blur-sm transition-colors">
                    Lihat Semua Data &rarr;
                </a>
            </div>
            <i class="fa-solid fa-shapes absolute -bottom-4 -right-4 text-8xl text-white/5 rotate-12"></i>
        </div>

    </div>
</div>
@endsection