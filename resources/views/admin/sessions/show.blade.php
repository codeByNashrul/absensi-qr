<x-app-layout>
    <x-slot name="header">Detail Sesi Absensi</x-slot>

    <div class="bg-white rounded-2xl shadow-sm border p-6 mb-6">
        <h3 class="text-xl font-bold">{{ $session->title }}</h3>
        <p class="text-slate-500 mt-1">Kegiatan: {{ $session->activity->name }}</p>
        <p class="text-slate-500">Tanggal: {{ $session->date }}</p>
        <p class="text-slate-500">Waktu: {{ $session->start_time }} - {{ $session->end_time }}</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <form method="GET" action="/admin/sessions/{{ $session->id }}"
            class="bg-white rounded-2xl shadow-sm border p-4 mb-6 flex gap-4 items-end">

            <div>
                <label class="block text-sm font-medium mb-2">Kelas</label>

                <select name="class_id" class="rounded-xl border-slate-300">
                    <option value="">Semua kelas</option>

                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Cari Siswa</label>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama / NIS"
                    class="rounded-xl border-slate-300">
            </div>

            <button class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
                Filter
            </button>

            <a href="/admin/sessions/{{ $session->id }}" class="px-5 py-3 rounded-xl text-sm border">
                Reset
            </a>
        </form>
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left px-6 py-4">No</th>
                    <th class="text-left px-6 py-4">Nama Siswa</th>
                    <th class="text-left px-6 py-4">Kelas</th>
                    <th class="text-left px-6 py-4">Status</th>
                    <th class="text-left px-6 py-4">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                    @php
                        $attendance = $session->attendances->firstWhere('student_id', $student->id);
                    @endphp

                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $student->name }}</td>
                        <td class="px-6 py-4">{{ $student->schoolClass->name }}</td>
                        <td class="px-6 py-4">
                            {{ $attendance ? $attendance->status : 'belum absen' }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="/admin/sessions/{{ $session->id }}/manual-attendance">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">

                                <select name="status" class="rounded-xl border-slate-300 text-sm">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alfa">Alfa</option>
                                </select>

                                <button class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm">
                                    Simpan
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6">
            {{ $students->links() }}
        </div>
    </div>
</x-app-layout>
