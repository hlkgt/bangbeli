@extends('app')

@section('content')
    <div class="flex flex-col w-full p-8 gap-8">
        @foreach ($historys as $history)
            <div class="flex justify-between p-6 mb-12 rounded-lg shadow-lg">
                <h1>{{ $history->id }}</h1>
                <h1>{{ $history->product_name }}</h1>
                <h1>{{ $history->quantity }}</h1>
                <h1>{{ $history->price }}</h1>
                <h1>{{ $history->status }}</h1>
                @if ($history->status === 'success')
                    <button class="bg-teal-400 text-white font-semibold py-1 px-3">Payed</button>
                @elseif($history->status === 'pending')
                    <button class="bg-gray-400 text-white font-semibold p-2 rounded-lg">Waiting</button>
                @else
                    <button class="bg-red-400 text-white font-semibold p-2 rounded-lg">Canceled</button>
                @endif
            </div>
        @endforeach
    </div>
@endsection
