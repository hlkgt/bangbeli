@extends('app')

@section('content')
    <div class="w-full h-full rounded-xl shadow-lg p-8">
        @if (session('success'))
            <div class="py-3 bg-teal-300 text-teal-700 px-4 rounded-lg mb-6 flex items-center justify-between"
                id="notification">
                <p class="text-lg">{{ session('success') }}</p>
                <i class="fa-solid fa-xmark cursor-pointer p-2 text-2xl" id="close-button"></i>
            </div>
        @endif
        @foreach ($user as $usr)
            @if ($usr->status === 1)
                <div class="grid grid-cols-12 gap-6 grid-rows-3">
                    <form action="{{ route('post.profile') }}" method="post" class="col-span-8 row-span-3">
                        @csrf
                        <div class="mb-4">
                            <label for="name"
                                class="@error('name') text-red-400  @enderror text-xl font-semibold capitalize">name
                                account</label>
                            <input type="text" name="name" id="name"
                                class="w-full p-2 outline-2 border-2 rounded-lg @error('name') border-red-400 @enderror"
                                placeholder="Input name" value="{{ $usr->name }}">
                            @error('name')
                                <p class="text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email"
                                class="@error('email') text-red-400  @enderror text-xl font-semibold capitalize">email</label>
                            <input type="text" name="email" id="email"
                                class="w-full p-2 outline-2 border-2 rounded-lg @error('email') border-red-400 @enderror"
                                placeholder="Input email" value="{{ $usr->email }}">
                            @error('email')
                                <p class="text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="username"
                                class="@error('username') text-red-400  @enderror text-xl font-semibold capitalize">username</label>
                            <input type="text" name="username" id="username"
                                class="w-full p-2 outline-2 border-2 rounded-lg @error('username') border-red-400 @enderror"
                                placeholder="Input username" value="{{ $usr->username }}">
                            @error('username')
                                <p class="text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address"
                                class="@error('address') text-red-400  @enderror text-xl font-semibold capitalize">address</label>
                            <input type="text" name="address" id="address"
                                class="w-full p-2 outline-2 border-2 rounded-lg @error('address') border-red-400 @enderror"
                                placeholder="Input Your Address" value="{{ $usr->address }}">
                            @error('address')
                                <p class="text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="photo_profile"
                                class="@error('photo_profile') text-red-400  @enderror text-xl font-semibold capitalize">photo
                                profile</label>
                            <input type="text" name="photo_profile" id="photo_profile"
                                class="w-full p-2 outline-2 border-2 rounded-lg @error('photo_profile') border-red-400 @enderror"
                                placeholder="Input Photo Profile" value="{{ $usr->photo_profile }}">
                            @error('photo_profile')
                                <p class="text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="telephone"
                                class="@error('telephone') text-red-400  @enderror text-xl font-semibold capitalize">telephone</label>
                            <input type="number" name="telephone" id="telephone"
                                class="w-full p-2 outline-2 border-2 rounded-lg @error('telephone') border-red-400 @enderror"
                                placeholder="Input Your Phone Number" value="{{ $usr->telephone }}">
                            @error('telephone')
                                <p class="text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <button
                            class="w-full bg-yellow-400 py-3 my-4 rounded-lg text-xl font-semibold text-white hover:bg-yellow-500">Save
                            Profile</button>
                    </form>
                    <div class="col-span-4 rounded-xl shadow-xl row-span-2 p-4 flex justify-center items-center flex-col">
                        <h1>{{ $usr->name }}</h1>
                        <p>{{ $usr->email }}</p>
                        <table>
                            <tr>
                                <td>Name</td>
                                <td>{{ $usr->username }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $usr->address }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $usr->telephone }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @else
                <form action="{{ route('post.profile') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="username"
                            class="@error('username') text-red-400  @enderror text-xl font-semibold capitalize">username</label>
                        <input type="text" name="username" id="username"
                            class="w-full p-2 outline-2 border-2 rounded-lg @error('username') border-red-400 @enderror"
                            placeholder="Input username" value="{{ old('username') }}">
                        @error('username')
                            <p class="text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="address"
                            class="@error('address') text-red-400  @enderror text-xl font-semibold capitalize">address</label>
                        <input type="text" name="address" id="address"
                            class="w-full p-2 outline-2 border-2 rounded-lg @error('address') border-red-400 @enderror"
                            placeholder="Input Your Address" value="{{ old('address') }}">
                        @error('address')
                            <p class="text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="photo_profile"
                            class="@error('photo_profile') text-red-400  @enderror text-xl font-semibold capitalize">photo
                            profile</label>
                        <input type="text" name="photo_profile" id="photo_profile"
                            class="w-full p-2 outline-2 border-2 rounded-lg @error('photo_profile') border-red-400 @enderror"
                            placeholder="Input Photo Profile" value="{{ old('photo_profile') }}">
                        @error('photo_profile')
                            <p class="text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="telephone"
                            class="@error('telephone') text-red-400  @enderror text-xl font-semibold capitalize">telephone</label>
                        <input type="number" name="telephone" id="telephone"
                            class="w-full p-2 outline-2 border-2 rounded-lg @error('telephone') border-red-400 @enderror"
                            placeholder="Input Your Phone Number" value="{{ old('telephone') }}">
                        @error('telephone')
                            <p class="text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="w-full bg-yellow-400 py-3 my-4 rounded-lg text-xl font-semibold text-white hover:bg-yellow-500">Save
                        Profile</button>
                </form>
            @endif
        @endforeach
    </div>
@endsection

@section('js')
    <script>
        const closeBtn = document.getElementById("close-button");
        const notificationBox = document.getElementById("notification");

        closeBtn.addEventListener('click', function() {
            notificationBox.remove();
        });
    </script>
@endsection
