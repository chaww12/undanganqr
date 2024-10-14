<x-superadminlayout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="text-red-600 mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <div class="flex items-center">
        </div>
        <div class="ml-auto">
            <a href="{{ route('datauser') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                Kembali
            </a>
        </div>
    </div>
    

    <form action="{{ route('datauser.store') }}" method="POST">
        @csrf
        <div>
            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
            <input id="username" name="username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
        
        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>

        <div>
            <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
            <select id="role" name="role" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="admin">Admin</option>
                <option value="registrasi">Registrasi</option>
            </select>
        </div>

        <button type="submit" class="mt-4 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah User</button>
    </form>
</x-superadminlayout>
