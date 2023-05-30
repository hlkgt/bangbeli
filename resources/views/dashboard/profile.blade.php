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
        @if (session('error'))
            <div class="py-3 bg-red-300 text-red-700 px-4 rounded-lg mb-6 flex items-center justify-between"
                id="notification">
                <p class="text-lg">{{ session('error') }}</p>
                <i class="fa-solid fa-xmark cursor-pointer p-2 text-2xl" id="close-button"></i>
            </div>
        @endif
        @foreach ($user as $usr)
            @if ($usr->status === 1)
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div
                        class="col-span-1 lg:col-start-9 lg:col-end-13  rounded-xl shadow-xl p-4 flex justify-between items-center flex-col gap-4">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('storage/' . $usr->photo_profile) }}" alt="profile-user"
                                class="rounded-full mb-4 lg:w-80">
                            <h1 class="font-semibold text-xl">{{ $usr->username }}</h1>
                            <p>{{ $usr->address }}</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <p><i class="fa-solid fa-user mr-1"></i>{{ $usr->name }} | <i
                                    class="fa-solid fa-envelope mr-1"></i>{{ $usr->email }}</p>
                            <p><i class="fa-solid fa-phone mr-1"></i>{{ $usr->telephone }}</p>
                            <div class="flex justify-center items-center">
                                <form action="{{ route('delete.profile') }}" method="post" class="p-4">
                                    @csrf
                                    @method('delete')
                                    <p class="mb-1 text-center">type <b>DELETE</b> before deleting account</p>
                                    <input type="text" name="delete-account"
                                        class="w-full p-2 border-2 rounded-lg text-center outline-gray-500 @error('delete-account')
                                            border-red-400
                                        @enderror"
                                        placeholder="DELETE">
                                    @error('delete-account')
                                        <p class="text-semibold text-red-400">{{ $message }}</p>
                                    @enderror
                                    <button type="submit"
                                        class="bg-red-500 w-full text-white py-2 rounded-lg font-semibold mt-3">
                                        Delete Account
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('update.profile') }}" method="post"
                        class="col-span-1 lg:col-span-8 lg:col-start-1 lg:col-end-9 lg:row-start-1"
                        enctype="multipart/form-data">
                        @method('PATCH')
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
                            <img src="" alt="" width="200" id="image-preview">
                            <input type="file" name="photo_profile" id="photo_profile"
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
                </div>
            @else
                <form action="{{ route('post.profile') }}" method="post" enctype="multipart/form-data">
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
                        <img src="" alt="" width="200" id="image-preview">
                        <input type="file" name="photo_profile" id="photo_profile"
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
        const inputImage = document.querySelector("#photo_profile");
        inputImage.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const result = reader.result;
                    const imagePreview = document.querySelector("#image-preview");
                    imagePreview.src = result;
                    imagePreview.alt = "image-user";
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
