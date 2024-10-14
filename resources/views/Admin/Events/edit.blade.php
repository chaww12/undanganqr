<x-adminlayout>
    <x-slot:title>Edit Event</x-slot:title>
     
    <div class="container mx-auto p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold mb-6">{{ $event->namaevent }}</h1>
            <div class="flex items-center">
                <a href="{{ route('admin.events.show', $event->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                    Kembali
                </a>
            </div>
        </div>
        
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <div class="mb-4">
                <label for="poster" class="block text-sm font-medium text-gray-700">Poster (optional)</label>
                <input type="file" name="poster" id="poster" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                @if ($event->poster)
                    <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="h-48 w-48 object-cover mt-2">
                @endif
            </div>
            <div class="mb-4">
                <label for="namaevent" class="block text-sm font-medium text-gray-700">Nama Event</label>
                <input type="text" name="namaevent" id="namaevent" value="{{ $event->namaevent }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="waktu" class="block text-sm font-medium text-gray-700">Waktu</label>
                <input type="datetime-local" name="waktu" id="waktu" value="{{ \Carbon\Carbon::parse($event->waktu)->format('Y-m-d\TH:i') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    <option value="mendatang">Mendatang</option>
                    <option value="sedang berlangsung">Sedang Berlangsung</option>
                    <option value="sudah terlaksana">Sudah Terlaksana</option>
                </select>
            </div>            
            <div>
                <button type="submit" class="inline-flex items-center px-20 py-3 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">Update</button>
            </div>
        </form>
    </div>
</x-adminlayout>
