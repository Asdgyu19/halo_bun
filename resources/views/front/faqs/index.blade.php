@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
<h1 class="text-2xl font-bold mb-4">FAQ Kesehatan</h1>
<form method="GET" class="flex gap-2 mb-4">
  <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pertanyaan..." class="border p-2 rounded flex-1">
  <button class="bg-[var(--blue)] text-white px-4 rounded">Cari</button>
</form>
<div class="space-y-4">
  @foreach($faqs as $faq)
    <details class="bg-white p-4 border rounded">
      <summary class="font-semibold text-[var(--blue)]">{{ $faq->question }}</summary>
      <p class="mt-2 text-slate-700">{{ $faq->answer }}</p>
    </details>
  @endforeach
</div>
</div>
{{ $faqs->links() }}
@endsection
iy