<x-app-layout>
    <x-slot name="header">Tambah Kelas</x-slot>

    <div class="max-w-xl bg-white rounded-2xl shadow-sm border p-6">
        <form method="POST" action="/admin/classes">
            @csrf

            <label class="block text-sm font-medium mb-2">Nama Kelas</label>
            <input type="text" name="name" class="w-full rounded-xl border-slate-300">

            <button class="mt-6 bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>