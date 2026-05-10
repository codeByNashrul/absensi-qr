<x-app-layout>
    <x-slot name="header">
        Rekap Absensi
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <form method="GET" action="/admin/attendances"
            class="bg-white rounded-2xl shadow-sm border p-4 mb-6 flex gap-4 items-end">
            <div>
                <label class="block text-sm font-medium mb-2">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" class="rounded-xl border-slate-300">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Kegiatan</label>
                <select name="activity_id" class="rounded-xl border-slate-300">
                    <option value="">Semua kegiatan</option>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}"
                            {{ request('activity_id') == $activity->id ? 'selected' : '' }}>
                            {{ $activity->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
                Filter
            </button>

            <a href="/admin/attendances" class="px-5 py-3 rounded-xl text-sm border">
                Reset
            </a>
        </form>
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left px-6 py-4">No</th>
                    <th class="text-left px-6 py-4">Nama Siswa</th>
                    <th class="text-left px-6 py-4">Kelas</th>
                    <th class="text-left px-6 py-4">Kegiatan</th>
                    <th class="text-left px-6 py-4">Status</th>
                    <th class="text-left px-6 py-4">Waktu Scan</th>
                </tr>
            </thead>

            <tbody>
                @forelse($attendances as $attendance)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>

                        <td class="px-6 py-4">
                            {{ $attendance->student->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $attendance->student->schoolClass->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $attendance->session->activity->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $attendance->status }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $attendance->scan_time }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-slate-500">
                            Belum ada data absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
