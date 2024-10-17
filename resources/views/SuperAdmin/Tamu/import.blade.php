<x-superadminlayout>
    <x-slot:title>Import Data Tamu</x-slot:title>

    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Import Data</h1>

            <!-- Tombol Kembali di sebelah kanan -->
            <a href="{{ route('superadmin.tamu.show', $eventId) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-500">
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-4">
                <div class="text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('superadmin.tamu.import.post', $eventId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Pilih File CSV</label>
                <input type="file" name="file" id="file" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                    Import Data
                </button>
            </div>
        </form>
    </div>
</x-superadminlayout>
