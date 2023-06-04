<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - BangBeli</title>
    @vite(['resources/css/app.css', 'resources/css/fontawesome.css', 'resources/css/solid.css'])
</head>

<body>
    <div class="min-h-screen bg-yellow-400 flex justify-center items-center">
        <form action="{{ route('login.account') }}" method="post" class="rounded-xl shadow-lg bg-white p-4 w-[30rem]">
            @if (session('info'))
                <div id="notification"
                    class="text-sky-400 font-semibold bg-sky-200 py-4 mb-4 px-2 flex justify-between items-center">
                    {{ session('info') }}
                    <i class="fa-solid fa-xmark text-lg cursor-pointer p-2"></i>
                </div>
            @endif
            <h1 class="text-center my-2 text-yellow-400 text-4xl font-bold">BangBeli</h1>
            @csrf
            <div class="mb-2 flex flex-col">
                <label for="email" class="text-lg mb-2 font-semibold">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan Email"
                    class="border-2 p-2 rounded-md @error('email') outline-2 border-red-400 outline-red-400 @enderror"
                    value="{{ old('email') }}" autofocus />
                @error('email')
                    <p class="text-red-400 font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2 flex flex-col">
                <label for="password" class="text-lg mb-2 font-semibold">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan Password"
                    class="border-2 p-2 rounded-md @error('password') outline-2  border-red-400 outline-red-400 @enderror" />
                @error('password')
                    <p class="text-red-400 font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <p class="py-3 capitalize text-center">belum mempunyai akun? <a href="{{ route('register') }}"
                    class="text-blue-600 underline">daftar</a></p>
            <button
                class="w-full text-center py-3 bg-yellow-400 rounded-xl shadow-lg text-lg font-semibold text-white capitalize"
                type="submit">masuk</button>
        </form>
    </div>

    <script>
        const notif = document.querySelector('#notification')
        setTimeout(() => {
            notif.remove();
        }, 5000);
    </script>
</body>

</html>
