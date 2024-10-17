<x-superadminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="bg-blue-100 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold">Total Users</h3>
            <p class="text-2xl">{{ $totalUsers }}</p>
        </div>
  
        <div class="bg-blue-100 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold">Admin</h3>
            <p class="text-2xl">{{ $adminUsersCount }}</p>
        </div>
  
        <div class="bg-blue-100 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold">Registrasi</h3>
            <p class="text-2xl">{{ $registrasiUsersCount }}</p>
        </div>    
    </div>

    <div class="my-6 border-t border-gray-300"></div>
  
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-green-100 shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold">Total Event</h2>
            <p class="text-2xl">{{ $totalEvents }}</p>
        </div>
  
        <div class="bg-green-100 shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold">Event Sudah Terlaksana</h2>
            <p class="text-2xl">{{ $eventsTerlaksana }}</p>
        </div>
  
        <div class="bg-green-100 shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold">Event Berlangsung</h2>
            <p class="text-2xl">{{ $eventsBerlangsung }}</p>
        </div>
  
        <div class="bg-green-100 shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold">Event Mendatang</h2>
            <p class="text-2xl">{{ $eventsPending }}</p>
        </div>
    </div>
  </x-superadminlayout>
  