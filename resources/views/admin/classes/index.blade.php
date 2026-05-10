<x-app-layout>
    <x-slot name="header">
        Data Kelas
    </x-slot>

    <div class="mb-6">
        <a href="/admin/classes/create"
           class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm font-medium">
            + Tambah Kelas
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left px-6 py-4 text-sm">No</th>
                    <th class="text-left px-6 py-4 text-sm">Nama Kelas</th>
                </tr>
            </thead>

            <tbody>
                @forelse($classes as $class)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $class->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-6 text-center text-slate-500">
                            Belum ada data kelas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>