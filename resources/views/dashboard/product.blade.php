@extends('app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <div class="col-span-1 rounded-xl shadow-xl p-6 flex flex-col gap-2">
                <img src="..." alt="food-image" width="200" class="mx-auto">
                <h1 class="text-center font-semibold text-xl">{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p>Price : {{ $product->price }}</p>
                <p>Stock : {{ $product->stock }}</p>
                <p>{{ $product->rate }}</p>
                <input type="string" id="quantity" placeholder="Berapa Pesananmu?"
                    class="p-2 border-2 border-gray-300 w-full rounded-lg">
                <form action="" method="post">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="qty" id="qty" value="{{ $product->qty }}">
                    <button type="submit" class="w-full bg-orange-400 py-2 rounded-lg text-white font-semibold">Add To
                        Cart
                    </button>
                </form>
                <button class="bg-yellow-400 py-2 text-white font-semibold rounded-lg">Buy Now</button>
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
