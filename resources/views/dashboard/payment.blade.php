@extends('app')

@section('content')
    <div class="rounded-lg shadow-lg p-8">
        <form action="#" id="form-payment">
            <div class="mb-4">
                <input type="hidden" name="user_id" id="user_id" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input product id" value="{{ auth()->user()->id }}" readonly>
            </div>
            <div class="mb-4">
                <label for="product_id" class="text-xl font-semibold capitalize mb-2">product id</label>
                <input type="text" name="product_id" id="product_id" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input product id" value="{{ $list['product_id'] }}" readonly>
            </div>
            <div class="mb-4">
                <label for="name" class="text-xl font-semibold capitalize mb-2">name</label>
                <input type="text" name="name" id="name" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input name" value="{{ $user->username }}" readonly>
            </div>
            <div class="mb-4">
                <label for="address" class="text-xl font-semibold capitalize mb-2">address</label>
                <input type="text" name="address" id="address" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input address" value="{{ $user->address }}" readonly>
            </div>
            <div class="mb-4">
                <label for="telephone" class="text-xl font-semibold capitalize mb-2">telephone</label>
                <input type="text" name="telephone" id="telephone" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input telephone" value="{{ $user->telephone }}" readonly>
            </div>
            <div class="mb-4">
                <label for="username" class="text-xl font-semibold capitalize mb-2">username</label>
                <input type="text" name="username" id="username" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input name" value="{{ $user->name }}" readonly>
            </div>
            <div class="mb-4">
                <label for="email" class="text-xl font-semibold capitalize mb-2">email</label>
                <input type="text" name="email" id="email" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input email" value="{{ $user->email }}" readonly>
            </div>
            <div class="mb-4">
                <label for="product_name" class="text-xl font-semibold capitalize mb-2">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="w-full p-2 outline-2 border-2 rounded-lg"
                    placeholder="Input name product" value="{{ $list['product_name'] }}" readonly>
            </div>
            <div class="mb-4">
                <label for="product_price" class="text-xl font-semibold capitalize mb-2">Price</label>
                <input type="text" name="product_price" id="product_price"
                    class="w-full p-2 outline-2 border-2 rounded-lg" placeholder="Input price" value="{{ $list['price'] }}"
                    readonly>
            </div>
            <div class="mb-4">
                <label for="product_quantity" class="text-xl font-semibold capitalize mb-2">Quantity</label>
                <input type="number" name="product_quantity" id="product_quantity"
                    class="w-full p-2 outline-2 border-2 rounded-lg" placeholder="Input quantity"
                    value="{{ $list['quantity'] }}" readonly>
            </div>
            <button class="py-3 bg-teal-400 text-lg w-full rounded-lg font-semibold text-white">Pay</button>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        $(function() {
            $("#form-payment").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/api/dashboard/product/payment/process",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: $("#name").val(),
                        address: $("#address").val(),
                        telephone: $("#telephone").val(),
                        username: $("#username").val(),
                        user_id: $("#user_id").val(),
                        product_id: $("#product_id").val(),
                        product_name: $("#product_name").val(),
                        product_price: $("#product_price").val(),
                        product_quantity: $("#product_quantity").val(),
                    },
                    success: function(response) {
                        snap.pay(response.snap_token, {
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
                });
            });
        });
    </script>
@endsection