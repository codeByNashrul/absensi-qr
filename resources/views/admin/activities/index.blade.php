<x-app-layout>
    <x-slot name="header">Data Kegiatan</x-slot>

    <a href="/admin/activities/create"
       class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
        + Tambah Kegiatan
    </a>

    <div class="bg-white rounded-2xl shadow-sm border mt-6 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left px-6 py-4">No</th>
                    <th class="text-left px-6 py-4">Kategori</th>
                    <th class="text-left px-6 py-4">Nama Kegiatan</th>
                    <th class="text-left px-6 py-4">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $activity->category->name }}</td>
                        <td class="px-6 py-4">{{ $activity->name }}</td>
                        <td class="px-6 py-4">{{ $activity->description ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-slate-500">
                            Belum ada kegiatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>