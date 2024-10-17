<x-superadminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($events as $event)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="font-bold text-lg mb-2">{{ $event->namaevent }}</h2>
                    <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($event->waktu)->format('d M Y H:i') }}</p>
                    <p><strong>Status:</strong> {{ $event->status }}</p>
                    <a href="{{ route('superadmin.tamu.show', $event->id) }}" class="inline-block mt-2 text-indigo-600 hover:text-indigo-500">Lihat Tamu</a>
                </div>
            @endforeach
        </div>
    </div>
</x-superadminlayout>
