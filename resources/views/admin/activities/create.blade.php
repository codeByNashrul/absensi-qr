<x-app-layout>
    <x-slot name="header">Tambah Kegiatan</x-slot>

    <div class="max-w-xl bg-white rounded-2xl shadow-sm border p-6">
        <form method="POST" action="/admin/activities">
            @csrf

            <label class="block text-sm font-medium mb-2">Kategori</label>
            <select name="activity_category_id" class="w-full rounded-xl border-slate-300 mb-4">
                <option value="">Pilih kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm font-medium mb-2">Nama Kegiatan</label>
            <input type="text" name="name" class="w-full rounded-xl border-slate-300 mb-4">

            <label class="block text-sm font-medium mb-2">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded-xl border-slate-300"></textarea>

            <button class="mt-6 bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>