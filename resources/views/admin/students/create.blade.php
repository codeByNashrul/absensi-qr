<x-app-layout>
    <x-slot name="header">Tambah Siswa</x-slot>

    <div class="max-w-xl bg-white rounded-2xl shadow-sm border p-6">
        <form method="POST" action="/admin/students">
            @csrf

            <label class="block text-sm font-medium mb-2">Kelas</label>
            <select name="school_class_id" class="w-full rounded-xl border-slate-300 mb-4">
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm font-medium mb-2">NIS</label>
            <input type="text" name="nis" class="w-full rounded-xl border-slate-300 mb-4">

            <label class="block text-sm font-medium mb-2">Nama Siswa</label>
            <input type="text" name="name" class="w-full rounded-xl border-slate-300 mb-4">

            <label class="block text-sm font-medium mb-2">Gender</label>
            <select name="gender" class="w-full rounded-xl border-slate-300">
                <option value="">Pilih gender</option>
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
            </select>

            <button class="mt-6 bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>