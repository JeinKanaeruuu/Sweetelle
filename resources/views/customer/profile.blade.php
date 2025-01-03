@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full transition-all duration-300 hover:shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800">Profil Anda</h1>
            <p class="text-gray-600 mt-2">Lihat dan edit informasi pribadi Anda</p>
        </div>

        <div class="flex flex-col items-center border-b border-gray-300 pb-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Profil</h2>
        
        <form id="edit-form" method="POST" action="{{ route('profile.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 shadow-sm" required placeholder="Masukkan nama baru">
            </div>
            <div class="flex items-center justify-between">
                <button id="save-button" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Simpan</button>
                <button id="cancel-button" type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200 hidden">Batal</button>
            </div>
        </form>

        <div class="flex justify-center mt-4">
            <button id="edit-button" class="flex items-center justify-center w-10 h-10 bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-200">
                <i class="fas fa-edit"></i>
            </button>
        </div>
    </div>
</div>

<script>
    const editButton = document.getElementById('edit-button');
    const editForm = document.getElementById('edit-form');
    const cancelButton = document.getElementById('cancel-button');

    editButton.addEventListener('click', () => {
        editForm.classList.remove('hidden');
        editButton.classList.add('hidden');
        cancelButton.classList.remove('hidden');
    });

    cancelButton.addEventListener('click', () => {
        editForm.reset();
        editForm.classList.add('hidden');
        editButton.classList.remove('hidden');
        cancelButton.classList.add('hidden');
    });
</script>
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
