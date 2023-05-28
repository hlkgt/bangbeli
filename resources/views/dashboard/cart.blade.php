@extends('app')

@section('content')
    <div class="w-full rounded-xl shadow-lg p-8">
        <div class="grid grid-cols-12 gap-2">
            @if (count($productLists) === 0)
                <h1 class="text-center font-semibold text-xl">Hemmm Sepertinya Kamu Belum Membeli Apa Apa</h1>
            @else
                @foreach ($productLists as $list)
                    <div class="col-span-12 hidden lg:flex items-center justify-between">
                        <div class="flex gap-2">
                            <img src="..." alt="image-food" width="100">
                            <div class="flex flex-col">
                                <h1>{{ $list->name }}</h1>
                                <p>Total Pembelian : {{ $list->quantity }}</p>
                            </div>
                        </div>
                        @if (!$list->status)
                            <p>Belum Dibayar</p>
                        @endif
                        <p>Rp.{{ $list->price }},00-</p>
                        <a href="{{ url('/dashboard/cart/delete-list?cart=' . $list->id . '&product=' . $list->product_id) }}"
                            class="text-red-400" onclick="return confirm('Hapus Order Sekarang')"><i
                                class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                    <div class="rounded-lg shadow-md col-span-12 md:col-span-6 flex flex-col gap-2 p-4 lg:hidden">
                        <img src="..." alt="image-food" width="100">
                        <h1 class="text-center font-semibold text-xl">{{ $list->name }}</h1>
                        <p>Total Pembelian : {{ $list->quantity }}</p>
                        @if (!$list->status)
                            <p>Belum Dibayar</p>
                        @endif
                        <p>Rp.{{ $list->price }},00-</p>
                        <a href="{{ url('/dashboard/cart/delete-list?cart=' . $list->id . '&product=' . $list->product_id) }}"
                            class="text-white bg-red-400 text-lg font-semibold rounded-md text-center w-full py-2"
                            onclick="return confirm('Hapus Order Sekarang')">
                            Delete
                        </a>
                    </div>
                @endforeach
                <div class="col-span-12 flex justify-end items-center gap-4">
                    <p><b>Rp.{{ $price }}.00-</b></p>
                    <button class="py-2 px-3 bg-teal-400 rounded-md text-lg font-semibold text-white">Buy Now</button>
                </div>
            @endif
        </div>
    </div>
@endsection
