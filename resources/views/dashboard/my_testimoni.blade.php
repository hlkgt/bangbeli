@extends('app')

@section('content')
    @if (session('success'))
        <div class="py-3 bg-teal-300 text-teal-700 px-4 rounded-lg mb-6 flex items-center justify-between" id="notification">
            <p class="text-lg">{{ session('success') }}</p>
            <i class="fa-solid fa-xmark cursor-pointer p-2 text-2xl" id="close-button"></i>
        </div>
    @endif
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 flex items-center py-2 rounded-xl gap-4">
            @if (count($myTestimonis) <= 0)
                <h1 class="text-xl">Kamu Belum Mengulas Apapun</h1>
            @else
                <h1 class="text-xl">Semua Ulasan Kamu</h1>
            @endif
            <a href="{{ route('dashboard.testimoni') }}" class="underline text-blue-400">Semua Ulasan</a>
            <a href="{{ route('show.create.testimoni') }}"
                class="py-2 px-3 bg-blue-400 rounded-xl font-semibold text-white">Tambah
                Ulasan</a>
        </div>
        @foreach ($myTestimonis as $testimoni)
            <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col rounded-lg shadow-lg">
                <div class="flex items-center gap-4 p-4">
                    <img src="{{ asset('storage/' . $testimoni->photo_profile) }}" alt="foto-profile"
                        class="w-16 rounded-full">
                    <div class="flex flex-col">
                        <h1 class="text-lg font-semibold">{{ $testimoni->name }}</h1>
                        <x-star :rate="$testimoni->rate"></x-star>
                    </div>
                </div>
                <p class="px-4 py-2">{{ $testimoni->description }}</p>
            </div>
        @endforeach
    </div>
@endsection
