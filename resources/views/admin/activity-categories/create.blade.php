<x-app-layout>
    <x-slot name="header">
        Tambah Kategori Kegiatan
    </x-slot>

    <div class="max-w-xl">
        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <form method="POST" action="/admin/activity-categories">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nama Kategori
                    </label>

                    <input type="text"
                           name="name"
                           class="w-full rounded-xl border-slate-300 focus:ring-slate-900 focus:border-slate-900">
                </div>

                <div class="mt-6">
                    <button class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm font-medium">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>