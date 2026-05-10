<x-app-layout>
    <x-slot name="header">Buat Sesi Absensi</x-slot>

    <div class="max-w-xl bg-white rounded-2xl shadow-sm border p-6">
        <form method="POST" action="/admin/sessions">
            @csrf

            <label class="block text-sm font-medium mb-2">Kegiatan</label>
            <select name="activity_id" class="w-full rounded-xl border-slate-300 mb-4">
                <option value="">Pilih kegiatan</option>
                @foreach($activities as $activity)
                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm font-medium mb-2">Judul Sesi</label>
            <input type="text" name="title" class="w-full rounded-xl border-slate-300 mb-4">

            <label class="block text-sm font-medium mb-2">Tanggal</label>
            <input type="date" name="date" class="w-full rounded-xl border-slate-300 mb-4">

            <label class="block text-sm font-medium mb-2">Jam Mulai</label>
            <input type="time" name="start_time" class="w-full rounded-xl border-slate-300 mb-4">

            <label class="block text-sm font-medium mb-2">Jam Selesai</label>
            <input type="time" name="end_time" class="w-full rounded-xl border-slate-300">

            <button class="mt-6 bg-slate-900 text-white px-5 py-3 rounded-xl text-sm">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>