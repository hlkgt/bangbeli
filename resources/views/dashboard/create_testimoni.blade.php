@extends('app')

@section('content')
    <div class="rounded-lg shadow-lg p-8">
        <form action="{{ route('create.testimoni') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" id="user_id" class="w-full p-2 outline-2 border-2 rounded-lg"
                placeholder="Input product id" value="{{ auth()->user()->id }}" readonly>
            <div class="mb-4 flex flex-col">
                <label for="name" class="text-xl font-semibold capitalize mb-2">rating ulasan</label>
                <select name="rate"
                    class="w-80 border-2 rounded-lg p-2 @error('rate')
                  border-red-400
                @enderror">
                    <option value="1">Rate 1</option>
                    <option value="2">Rate 2</option>
                    <option value="3">Rate 3</option>
                    <option value="4">Rate 4</option>
                    <option value="5" selected>Rate 5</option>
                </select>
                @error('rate')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="product_quantity" class="text-xl font-semibold capitalize mb-2">deskripsi ulasan</label>
                <textarea name="description" cols="30" rows="10"
                    class="w-full border-2 rounded-lg p-2 @error('description')
                    border-red-400
                @enderror"
                    placeholder="Ketik Ulasan">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 font-semibold text-lg">{{ $message }}</p>
                @enderror
            </div>
            <button class="py-3 bg-teal-400 text-lg w-full rounded-lg font-semibold text-white">Buat Ulasan</button>
        </form>
    </div>
@endsection
