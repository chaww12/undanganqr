<x-superadminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>
     
    <div class="container mx-auto p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold mb-6">{{ $event->namaevent }}</h1>
            <div class="flex items-center">
                <a href="{{ route('superadmin.events.edit', $event->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 rounded-md hover:bg-yellow-500 mr-2">
                Edit Event
                </a>
                <a href="{{ route('superadmin.events.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                Kembali
                </a>
            </div>
        </div>        
       
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Poster:</label>
            @if ($event->poster)
                <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="h-200 w-350 object-cover">
            @else
                <p>No Image</p>
            @endif
        </div>
           
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Waktu:</label>
            <p class="text-gray-600">{{ \Carbon\Carbon::parse($event->waktu)->format('d M Y H:i') }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Status:</label>
            <p class="text-gray-600">{{ $event->status }}</p>
        </div>
    </div>
</x-superadminlayout>
