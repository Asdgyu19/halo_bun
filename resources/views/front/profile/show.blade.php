@extends('layouts.app')
@section('content')

<h1 class="text-2xl font-bold text-[var(--blue)] mb-6">Profil Saya</h1>

<div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <form action="{{ url('/profile') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nama</label>
            <input type="text" name="name" value="{{ old('name',$user->name) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Username</label>
            <input type="text" name="username" value="{{ old('username',$user->username) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email',$user->email) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">No. Telepon</label>
            <input type="text" name="phone" value="{{ old('phone',$user->phone ?? '') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Kota Domisili</label>
            <input type="text" name="city" value="{{ old('city',$user->city ?? '') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Password Baru (opsional)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button class="bg-[var(--blue)] text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>
</div>

@endsection
