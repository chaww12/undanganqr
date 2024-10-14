<x-superadminlayout>
  <x-slot:title>{{ $title }}</x-slot:title>
  
  <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
      <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-lg font-semibold">Total Users</h3>
          <p class="text-2xl">{{ $totalUsers }}</p>
      </div>

      <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-lg font-semibold">Admin</h3>
          <p class="text-2xl">{{ $adminUsersCount }}</p>
      </div>

      <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-lg font-semibold">Registrasi</h3>
          <p class="text-2xl">{{ $registrasiUsersCount }}</p>
      </div>
  </div>
</x-superadminlayout>
