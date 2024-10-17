<x-superadminlayout>
    <x-slot:title>Preview Undangan</x-slot:title>

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold mb-6">{{ $event->namaevent }}</h1>
        <div class="flex items-center">
            <a href="#" onclick="checkTamu({{ $event->id }})" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 rounded-md hover:bg-yellow-500 mr-2">
                Buat Undangan (QR Code)
            </a>
            <a href="{{ route('superadmin.tamu.show', $event->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                Kembali
            </a>
        </div>
    </div>

    @if ($event->poster)
        <div class="relative mb-4">
            <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="w-auto h-auto max-w-full max-h-full">
            <div class="absolute" style="right: 112px; top: 310px; width: 260px; height: 300px;">
                <div class="bg-white border border-gray-300 rounded-md flex items-center justify-center" style="width: 100%; height: 100%;">
                    <p class="text-gray-400">QR</p>
                </div>
            </div>
        </div>
    @else
        <p class="text-gray-600">Tidak ada poster tersedia</p>
    @endif
    
    <script>
        function checkTamu(eventId) {
            fetch(`/admin/tamu/${eventId}/check`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Belum ada daftar tamu untuk event ini');
                    }
                    return response.json();
                })
                .then(data => {
                    window.location.href = `/admin/tamu/${eventId}/generate-qrcode`; 
                })
                .catch(error => {
                    alert(error.message); 
                });
        }
    </script>
    
</x-superadminlayout>
