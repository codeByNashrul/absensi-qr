<x-app-layout>
    <x-slot name="header">Data Siswa</x-slot>

    <a href="/admin/students/create"
       class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
        + Tambah Siswa
    </a>

    <div class="bg-white rounded-2xl shadow-sm border mt-6 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left px-6 py-4">No</th>
                    <th class="text-left px-6 py-4">NIS</th>
                    <th class="text-left px-6 py-4">Nama</th>
                    <th class="text-left px-6 py-4">Kelas</th>
                    <th class="text-left px-6 py-4">Gender</th>
                    <th class="text-left px-6 py-4">QR Token</th>
                </tr>
            </thead>

            <tbody>
                @forelse($students as $student)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $student->nis }}</td>
                        <td class="px-6 py-4">{{ $student->name }}</td>
                        <td class="px-6 py-4">{{ $student->schoolClass->name }}</td>
                        <td class="px-6 py-4">{{ $student->gender }}</td>
                        <td class="px-6 py-4">
                            {!! QrCode::size(70)->generate($student->qr_token) !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-slate-500">
                            Belum ada data siswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>