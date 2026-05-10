<x-app-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border">
            <p class="text-sm text-slate-500">Total Siswa</p>
            <h3 class="text-3xl font-bold mt-2">{{ $totalStudents }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border">
            <p class="text-sm text-slate-500">Total Kegiatan</p>
            <h3 class="text-3xl font-bold mt-2">{{ $totalActivities }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border">
            <p class="text-sm text-slate-500">Sesi Aktif</p>
            <h3 class="text-3xl font-bold mt-2">{{ $activeSessions }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border">
            <p class="text-sm text-slate-500">Hadir Hari Ini</p>
            <h3 class="text-3xl font-bold mt-2">{{ $todayAttendances }}</h3>
        </div>
    </div>
</x-app-layout>
