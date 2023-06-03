@extends('app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <div class="col-span-1 md:col-span-12 text-center font-semibold text-xl">
            <h1>Belum Ada Pembelian Apapun</h1>
        </div>
        @if (count($historys) <= 0)
        @else
            @foreach ($historys as $history)
                <div class="col-span-1 md:col-span-6 lg:col-span-4 rounded-xl shadow-xl p-6 flex flex-col gap-3">
                    <h1 class="text-center font-semibold text-xl">{{ $history->product_name }}</h1>
                    <p>Total Pembelian : {{ $history->quantity }}</p>
                    <p>Jumlah Pembayaran : {{ $history->price }}</p>
                    <p>Status Pembayaran : {{ $history->status }}</p>
                    <p>Tanggal Pembelian : {{ $history->created_at }}</p>
                    @if ($history->status === 'success')
                        <button class="bg-teal-400 text-white w-full font-semibold py-1 px-3 rounded-lg"
                            disabled>Berhasil</button>
                    @elseif($history->status === 'pending')
                        <button class="bg-gray-400 text-white font-semibold p-2 rounded-lg w-full"
                            onclick="payNow('{{ $history->snap_token }}')">Menunggu Pembayaran</button>
                    @else
                        <button class="bg-red-400 text-white font-semibold p-2 rounded-lg" disabled>Dibatalkan</button>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('js')
    <script>
        function payNow(snapToken) {
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    $.ajax({
                        type: "POST",
                        url: "/api/dashboard/handle-stock",
                        data: {
                            product_id: $("#product_id").val(),
                            product_quantity: $(
                                "#product_quantity").val(),
                        },
                        success: function(response) {
                            window.location.href =
                                "/dashboard/history"
                        }
                    });
                },
                onPending: function(result) {
                    window.location.href = "/dashboard/history"
                },
                onError: function(result) {
                    window.location.href = "/dashboard/history"
                },
                onClose: function() {
                    window.location.href = "/dashboard/product"

                }
            });
        }
    </script>
@endsection
