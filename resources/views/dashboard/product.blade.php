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
            <div class="col-span-1 rounded-xl shadow-xl p-6 flex flex-col justify-between">
                <div class="flex flex-col">
                    <img src="{{ asset('storage/photo-profile/foto-adminleo.jpg') }}" alt="food-image" width="200"
                        class="mx-auto">
                    <h1 class="text-center font-semibold text-xl">{{ $product->name }}</h1>
                    <p>{{ $product->description }}</p>
                    <p><b>Harga :</b> {{ $product->price }}</p>
                    <p><b>Stock :</b> {{ $product->stock }} Barang</p>
                    <p><b>Terjual :</b> {{ $product->sold }}</p>
                    <x-star :rate="$product->rate"></x-star>
                </div>
                @if (auth()->user()->role === 'admin')
                    <a href="{{ url('/dashboard/product/update-view?product-id=') . $product->id }}"
                        class="bg-blue-400 py-2 text-white font-semibold rounded-lg w-full text-center">Ubah Product</a>
                @else
                    <div class="flex flex-col gap-2">
                        @if ($product->stock === 0)
                            <input placeholder="Sorry Sold !" class="p-2 border-2 border-gray-300 w-full rounded-lg"
                                disabled="true">
                            <button class="bg-gray-400 py-2 text-white font-semibold rounded-lg"
                                disabled="true">Habis</button>
                        @else
                            <input type="number" id="quantity" placeholder="Berapa Pesananmu?"
                                class="p-2 border-2 border-gray-300 w-full rounded-lg">
                            <form action="{{ route('payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="id_product" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="qty">
                                <button class="bg-yellow-400 py-2 text-white font-semibold rounded-lg w-full">Beli
                                    Sekarang</button>
                            </form>
                        @endif
                    </div>
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
