<x-superadminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    @if(session('success'))
        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto p-6">     
        <div class="mb-4">
            <a href="{{ route('superadmin.events.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                Tambah Event
            </a>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Event</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($events as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->namaevent }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->waktu }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('superadmin.events.show', $event->id) }}" class="text-indigo-600 hover:text-indigo-500 mr-4">Lihat</a>
                            <form action="{{ route('superadmin.events.destroy', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</x-superadminlayout>
