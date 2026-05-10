<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absensi QR Sekolah</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white hidden md:flex md:flex-col">
            <div class="h-16 flex items-center px-6 border-b border-slate-700">
                <div>
                    <h1 class="font-bold text-lg">Absensi QR</h1>
                    <p class="text-xs text-slate-400">Sekolah Digital</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="/admin/dashboard" class="block px-4 py-3 rounded-xl hover:bg-slate-800 text-sm">
                    Dashboard
                </a>
                <a href="/admin/students" class="block px-4 py-3 rounded-xl hover:bg-slate-800 text-sm">
                    Data Siswa
                </a>

                <a href="/admin/classes" class="block px-4 py-3 rounded-xl hover:bg-slate-800 text-sm">
                    Data Kelas
                </a>

                <a href="/admin/activity-categories" class="block px-4 py-3 rounded-xl hover:bg-slate-800 text-sm">
                    Kategori Kegiatan
                </a>

                <a href="/admin/activities" class="block px-4 py-3 rounded-xl hover:bg-slate-800 text-sm">
                    Kegiatan
                </a>

                <a href="/admin/sessions" class="block px-4 py-3 rounded-xl hover:bg-slate-800 text-sm">
                    Sesi Absensi
                </a>

                <a href="/admin/attendances" class="block px-4 py-3 rounded-xl hover:bg-slate-800 text-sm">
                    Rekap Absensi
                </a>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-red-600 text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6">
                <div>
                    <h2 class="font-semibold text-lg">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                    <p class="text-xs text-slate-500">Sistem Absensi Online Berbasis QR Code</p>
                </div>

                <div class="text-sm text-slate-600">
                    {{ auth()->user()->name ?? 'User' }}
                </div>
            </header>

            <section class="p-6">
                {{ $slot }}
            </section>
        </main>

    </div>
</body>

</html>
