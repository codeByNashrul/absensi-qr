<x-app-layout>
    <x-slot name="header">
        Scanner Absensi
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border p-6">
        <h3 class="text-xl font-bold">{{ $session->title }}</h3>
        <p class="text-slate-500 mt-1">
            Kegiatan: {{ $session->activity->name }}
        </p>

        <div class="mt-6">
            <div id="reader" class="w-full max-w-md"></div>
        </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let isScanning = false;

    const scanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: 250
        },
        false
    );

    scanner.render(function(decodedText) {
        if (isScanning) return;

        isScanning = true;

        fetch("/admin/sessions/{{ $session->id }}/scan", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                qr_token: decodedText
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Terabsen',
        text: data.student,
        timer: 1500,
        showConfirmButton: false
    });
} else {
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: data.message,
        timer: 1500,
        showConfirmButton: false
    });
}

            setTimeout(() => {
                isScanning = false;
            }, 1500);
        });
    });
</script>
</x-app-layout>