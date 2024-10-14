<x-adminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-bold">Total Event</h2>
                <p class="text-2xl">{{ $totalEvents }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-bold">Event Sudah Terlaksana</h2>
                <p class="text-2xl">{{ $eventsTerlaksana }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-bold">Event Berlangsung</h2>
                <p class="text-2xl">{{ $eventsBerlangsung }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-bold">Event Mendatang</h2>
                <p class="text-2xl">{{ $eventsPending }}</p>
            </div>
        </div>
    </div>
</x-adminlayout>
