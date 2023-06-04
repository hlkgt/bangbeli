<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - BangBeli</title>
    @vite(['resources/css/app.css', 'resources/css/fontawesome.css', 'resources/css/solid.css'])
</head>

<body>
    <div class="min-h-screen bg-yellow-400 flex justify-center items-center">
        <form action="{{ route('register.account') }}" method="post" class="rounded-xl shadow-lg bg-white p-4 w-[30rem]">
            @if (session('error'))
                <div id="notification"
                    class="text-red-400 font-semibold bg-red-200 py-4 mb-4 px-2 flex justify-between items-center">
                    {{ session('error') }}
                    <i class="fa-solid fa-xmark text-lg cursor-pointer p-2"></i>
                </div>
            @endif
            @csrf
            <h1 class="text-center my-2 text-yellow-400 text-4xl font-bold">BangBeli</h1>
            <div class="mb-2 flex flex-col">
                <label for="name" class="text-lg mb-2 font-semibold">Name</label>
                <input type="text" name="name" id="name" placeholder="Masukkan Username"
                    class="border-2 p-2 rounded-md @error('name') outline-2 border-red-400 outline-red-400 @enderror"
                    value="{{ old('name') }}" autofocus />
                @error('name')
                    <p class="text-red-400 font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2 flex flex-col">
                <label for="email" class="text-lg mb-2 font-semibold">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan Email"
                    class="border-2 p-2 rounded-md @error('email') outline-2 border-red-400 outline-red-400 @enderror"
                    value="{{ old('email') }}" />
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
            <div class="mb-4 flex flex-col">
                <label for="cpassword" class="text-lg mb-2 font-semibold">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password"
                    class="border-2 p-2 rounded-md @error('cpassword') outline-2 border-red-400 outline-red-400 @enderror" />
                @error('cpassword')
                    <p class="text-red-400 font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <p class="text-center mt-2 mb-4 capitalize">sudah mempunyai akun? <a href="{{ route('login') }}"
                    class="text-blue-600 underline">masuk</a></p>
            <button
                class="w-full text-center py-3 bg-yellow-400 rounded-xl shadow-lg text-lg font-semibold text-white capitalize"
                type="submit">daftar</button>
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
