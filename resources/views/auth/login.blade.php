<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Manajemen</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Inter', sans-serif;
    }
    </style>
</head>

<body class="bg-slate-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-200/60">

        <!-- Header Card -->
        <div class="bg-indigo-600 px-8 py-6 text-white text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/10 mb-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457-.39-2.823-1.07-4" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold tracking-tight">Selamat Datang</h2>
            <p class="text-indigo-200 text-sm mt-1">Silakan masuk ke akun Anda</p>
        </div>

        <!-- Body Form -->
        <div class="p-8">

            <!-- Alert Notifikasi Sukses / Logout -->
            @if (session('success'))
            <div
                class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Email / Nama Pengguna -->
                <div>
                    <label for="login_key" class="block text-sm font-medium text-slate-700 mb-1">
                        Email atau Nama Pengguna
                    </label>
                    <input type="text" id="login_key" name="login_key" value="{{ old('login_key') }}"
                        placeholder="nama@email.com atau username"
                        class="w-full px-4 py-2.5 rounded-lg border @error('login_key') border-red-500 focus:ring-red-500 @else border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror focus:outline-none focus:ring-2 text-slate-800 transition"
                        required autofocus>

                    @error('login_key')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Input Kata Sandi -->
                <div>
                    <label for="kata_sandi" class="block text-sm font-medium text-slate-700 mb-1">
                        Kata Sandi
                    </label>
                    <input type="password" id="kata_sandi" name="kata_sandi" placeholder="••••••••"
                        class="w-full px-4 py-2.5 rounded-lg border @error('kata_sandi') border-red-500 focus:ring-red-500 @else border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror focus:outline-none focus:ring-2 text-slate-800 transition"
                        required>

                    @error('kata_sandi')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Checkbox Remember Me -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white font-semibold rounded-lg shadow-md transition duration-200 ease-in-out">
                    Masuk Sekarang
                </button>
            </form>
        </div>

        <!-- Footer Card -->
        <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} Aplikasi Manajemen. All rights reserved.
        </div>

    </div>

</body>

</html>