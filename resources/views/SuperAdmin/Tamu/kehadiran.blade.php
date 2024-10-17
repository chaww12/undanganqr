<x-superadminlayout>
    <x-slot:title>Kehadiran Tamu</x-slot:title>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Kehadiran Tamu {{ $event->namaevent }}</h1>

        <div class="flex justify-between mb-4">
            <!-- Tombol Export Excel di sebelah kiri -->
            <a href="{{ route('supexport.tamu', $event->id) }}" 
               class="px-4 py-2 bg-green-500 text-white font-bold rounded-lg hover:bg-green-600">
               Export (Excel)
            </a>

            <!-- Tombol Kembali di sebelah kanan -->
            <a href="{{ route('superadmin.tamu.show', $event->id) }}" 
               class="px-4 py-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600">
               Kembali
            </a>
        </div>

        <div class="overflow-hidden bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Tamu</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <!-- Tombol Hapus -->
                                <form action="{{ route('superadmin.tamu.unregister', $tamu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus registrasi tamu ini?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600">
                                        Hapus Registrasi
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-superadminlayout>
