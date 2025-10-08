@extends('layouts.app')
@section('content')

<h1 class="text-2xl font-bold text-[var(--blue)] mb-4">Daftar Dokter Kandungan</h1>

<div class="grid md:grid-cols-2 gap-6">
    @foreach($doctors as $doctor)
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg">{{ $doctor->name }}</h2>
        <p class="text-sm text-slate-600">{{ $doctor->specialization }}</p>
        <p class="text-sm">Email: {{ $doctor->email }}</p>
        <p class="text-sm">Telp: {{ $doctor->phone }}</p>

        @auth
        <form action="{{ url('/consult') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
            <textarea name="message" rows="2" class="w-full border rounded p-2" placeholder="Tulis pertanyaan..."></textarea>
            <button class="mt-2 bg-[var(--blue)] text-white px-3 py-1 rounded">Kirim Pertanyaan</button>
        </form>
        @else
        <p class="mt-3 text-sm text-slate-500">Login untuk konsultasi.</p>
        @endauth
    </div>
    @endforeach
</div>

@endsection
