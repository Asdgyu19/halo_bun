@extends('layouts.app')
@section('content')

<h1 class="text-2xl font-bold text-[var(--blue)] mb-4">Forum Bunda</h1>

<!-- Form tambah thread -->
@auth
<form action="{{ url('/threads') }}" method="POST" class="mb-6">
    @csrf
    <textarea name="content" rows="3" class="w-full border rounded p-2" placeholder="Tulis pengalaman Anda..."></textarea>
    <button class="mt-2 bg-[var(--blue)] text-white px-4 py-2 rounded">Kirim</button>
</form>
@endauth

<!-- Daftar thread -->
@foreach($threads as $thread)
<div class="bg-white p-4 rounded shadow mb-4">
    <p class="mb-2"><strong>{{ $thread->user->name }}</strong>:</p>
    <p class="mb-3">{{ $thread->content }}</p>

    <!-- Reaksi -->
    <form action="{{ url('/threads/'.$thread->id.'/react') }}" method="POST" class="inline">
        @csrf
        <button class="text-blue-600">{{ $thread->reactions->count() }} ❤️</button>
    </form>

    <!-- Komentar -->
    <div class="mt-3 pl-4 border-l">
        @foreach($thread->comments as $comment)
            <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
        @endforeach

        @auth
        <form action="{{ url('/threads/'.$thread->id.'/comment') }}" method="POST" class="mt-2">
            @csrf
            <input type="text" name="content" placeholder="Tulis komentar..." class="border rounded px-2 py-1 w-full">
        </form>
        @endauth
    </div>
</div>
@endforeach

{{ $threads->links() }}
@endsection
