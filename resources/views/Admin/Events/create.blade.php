<x-adminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="container mx-auto p-6">
        <div class="mb-4 flex justify-end">
            <a href="{{ url('/admin/events') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-500">
                Kembali
            </a>
        </div>
       
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="poster" class="block text-sm font-medium text-gray-700">Poster</label>
                <input type="file" name="poster" id="poster" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="namaevent" class="block text-sm font-medium text-gray-700">Nama Event</label>
                <input type="text" name="namaevent" id="namaevent" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="waktu" class="block text-sm font-medium text-gray-700">Waktu</label>
                <input type="datetime-local" name="waktu" id="waktu" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
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
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">Simpan</button>
            </div>
        </form>
    </div>
</x-adminlayout>
