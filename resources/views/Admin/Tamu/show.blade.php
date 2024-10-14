<x-adminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @if (session('success'))
        <div class="mb-4">
            <div class="text-green-600">
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    <div class="container mx-auto p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold mb-6">{{ $event->namaevent }}</h1>
            <div class="flex items-center">
                <a href="{{ route('admin.tamu.preview', $event->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 rounded-md hover:bg-yellow-500 mr-2">
                    Buat Undangan
                </a>
                <a href="{{ route('admin.tamu.import', $event->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-500 mr-2">
                    Import Data Tamu
                </a>
                <a href="{{ route('admin.tamu.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500 mr-2">
                    Kembali
                </a>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor</th> <!-- Ganti ID dengan Nomor -->
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Tamu</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">kkk</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tamus as $tamu)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td> 
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tamu->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tamu->jenistamu }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tamu->instansi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tamu->alamat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-adminlayout>
