@extends('layouts.akademik')

@section('title', 'Pengaturan Akun')

@section('content')

<div class="max-w-4xl mx-auto space-y-8">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                <i class="fa-regular fa-id-card"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-800">Informasi Profil</h3>
                <p class="text-xs text-gray-500">Perbarui informasi akun dan alamat email Anda.</p>
            </div>
        </div>
        
        <div class="p-8">
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-600 mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-sm text-gray-800">
                                Alamat email Anda belum diverifikasi.
                                <button form="send-verification" class="underline text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Klik di sini untuk mengirim ulang email verifikasi.
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    Link verifikasi baru telah dikirim ke email Anda.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-gray-900 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-gray-300 hover:bg-gray-800 hover:shadow-xl active:scale-95 transition-all">
                        Simpan Profil
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p class="text-sm text-green-600 font-medium animate-pulse">
                            <i class="fa-solid fa-check mr-1"></i> Tersimpan.
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center">
                <i class="fa-solid fa-key"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-800">Ganti Password</h3>
                <p class="text-xs text-gray-500">Pastikan menggunakan password yang panjang dan acak agar aman.</p>
            </div>
        </div>

        <div class="p-8">
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-600 mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all @error('current_password', 'updatePassword') border-red-500 @enderror">
                    @error('current_password', 'updatePassword')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-600 mb-2">Password Baru</label>
                    <input type="password" name="password" id="password" autocomplete="new-password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all @error('password', 'updatePassword') border-red-500 @enderror">
                    @error('password', 'updatePassword')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-600 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all @error('password_confirmation', 'updatePassword') border-red-500 @enderror">
                    @error('password_confirmation', 'updatePassword')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-gray-900 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-gray-300 hover:bg-gray-800 hover:shadow-xl active:scale-95 transition-all">
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <p class="text-sm text-green-600 font-medium animate-pulse">
                            <i class="fa-solid fa-check mr-1"></i> Tersimpan.
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
        <div class="px-8 py-5 border-b border-red-100 bg-red-50/30 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="font-bold text-red-700">Hapus Akun</h3>
                <p class="text-xs text-red-500">Tindakan ini tidak dapat dibatalkan. Semua data akan hilang.</p>
            </div>
        </div>

        <div class="p-8">
            <div class="mb-6">
                <p class="text-sm text-gray-600">
                    Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
                </p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda YAKIN ingin menghapus akun ini secara permanen?');">
                @csrf
                @method('delete')

                <div class="flex flex-col md:flex-row items-start md:items-end gap-4">
                    <div class="w-full md:w-2/3">
                        <label for="password_delete" class="block text-sm font-bold text-red-700 mb-2">
                            Masukkan Password untuk Konfirmasi
                        </label>
                        <input type="password" name="password" id="password_delete" placeholder="Password Anda..."
                            class="w-full px-4 py-3 rounded-xl border border-red-200 focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition-all placeholder-red-200 text-red-900 @error('password', 'userDeletion') border-red-500 @enderror">
                        @error('password', 'userDeletion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-red-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-red-200 hover:bg-red-700 hover:shadow-xl active:scale-95 transition-all whitespace-nowrap">
                        <i class="fa-solid fa-trash-can mr-2"></i> Hapus Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection