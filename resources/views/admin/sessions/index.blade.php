<x-app-layout>
    <x-slot name="header">Sesi Absensi</x-slot>

    <a href="/admin/sessions/create" class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
        + Buat Sesi
    </a>

    <div class="bg-white rounded-2xl shadow-sm border mt-6 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left px-6 py-4">No</th>
                    <th class="text-left px-6 py-4">Judul</th>
                    <th class="text-left px-6 py-4">Kegiatan</th>
                    <th class="text-left px-6 py-4">Tanggal</th>
                    <th class="text-left px-6 py-4">Waktu</th>
                    <th class="text-left px-6 py-4">Status</th>
                    <th class="text-left px-6 py-4">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sessions as $session)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $session->title }}</td>
                        <td class="px-6 py-4">{{ $session->activity->name }}</td>
                        <td class="px-6 py-4">{{ $session->date }}</td>
                        <td class="px-6 py-4">{{ $session->start_time }} - {{ $session->end_time }}</td>
                        <td class="px-6 py-4">
                            {{ $session->is_active ? 'Aktif' : 'Nonaktif' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/admin/sessions/{{ $session->id }}/scanner"
                                class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm">
                                Scan
                            </a>
                            <a href="/admin/sessions/{{ $session->id }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-6 text-center text-slate-500">
                            Belum ada sesi absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
