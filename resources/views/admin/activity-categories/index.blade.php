<x-app-layout>
    <x-slot name="header">Kategori Kegiatan</x-slot>

    <a href="/admin/activity-categories/create"
       class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
        + Tambah Kategori
    </a>

    <div class="bg-white rounded-2xl shadow-sm border mt-6 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left px-6 py-4">No</th>
                    <th class="text-left px-6 py-4">Nama Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-6 text-center text-slate-500">
                            Belum ada kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>