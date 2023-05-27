@extends('app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @if (session('error'))
            <div class="col-span-1 md:col-span-2 lg:col-span-4 py-3 bg-red-300 text-red-700 px-4 rounded-lg mb-6 flex items-center justify-between"
                id="notification">
                <p class="text-lg">{{ session('error') }}</p>
                <i class="fa-solid fa-xmark cursor-pointer p-2 text-2xl" id="close-button"></i>
            </div>
        @endif
        @if (session('success'))
            <div class="col-span-1 md:col-span-2 lg:col-span-4 py-3 bg-teal-300 text-teal-700 px-4 rounded-lg mb-6 flex items-center justify-between"
                id="notification">
                <p class="text-lg">{{ session('success') }}</p>
                <i class="fa-solid fa-xmark cursor-pointer p-2 text-2xl" id="close-button"></i>
            </div>
        @endif
        @foreach ($products as $product)
            <div class="col-span-1 rounded-xl shadow-xl p-6 flex flex-col gap-2">
                <img src="..." alt="food-image" width="200" class="mx-auto">
                <h1 class="text-center font-semibold text-xl">{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p>Price : {{ $product->price }}</p>
                <p>Stock : {{ $product->stock }}</p>
                <p>{{ $product->rate }}</p>
                @if ($product->stock === 0)
                    <input placeholder="Sorry Sold !" class="p-2 border-2 border-gray-300 w-full rounded-lg"
                        disabled="true">
                    <button class="bg-gray-400 py-2 text-white font-semibold rounded-lg" disabled="true">SOLD</button>
                @else
                    <input type="number" id="quantity" placeholder="Berapa Pesananmu?"
                        class="p-2 border-2 border-gray-300 w-full rounded-lg">
                    <form action="{{ route('add-cart') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="quantity" id="qty" value="{{ $product->qty }}">
                        <button type="submit" class="w-full bg-orange-400 py-2 rounded-lg text-white font-semibold">
                            Pre-order
                        </button>
                    </form>
                    <button class="bg-yellow-400 py-2 text-white font-semibold rounded-lg">Buy Now</button>
                @endif
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <script>
        const inputNumber = document.querySelectorAll("#quantity");
        const inputQuantity = document.querySelectorAll("#qty");

        inputNumber.forEach((input, index) => {
            input.addEventListener("change", function(event) {
                let result = event.target.value;
                inputQuantity[index].value = result;
            })
        });
    </script>
@endsection