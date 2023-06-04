<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function postProfile(Request $request)
    {
        $dataUser = DataUser::where('user_id', auth()->user()->id)->first();
        $validated = $request->validate([
            'username' => 'required|min:5|',
            'address' => 'required',
            'photo_profile' => 'required|file|max:2048|dimensions:ratio=1/1|mimes:jpg,png,jpeg',
            'telephone' => 'numeric|min:11'
        ], [
            'photo_profile.dimensions' => 'The photo profile field has invalid image dimensions. required 1/1'
        ]);
        $path = $validated['photo_profile']->storeAs('photo-profile', rand(1, 1000000) . '-' . $validated['photo_profile']->getClientOriginalName());
        $list = ['username', 'address', 'telephone'];
        for ($i = 0; $i < count($list); $i++) {
            $dataUser[$list[$i]] = $validated[$list[$i]];
        }
        $dataUser->photo_profile = $path;
        $dataUser->status = true;
        $dataUser->save();
        return redirect()->route('dashboard.profile')->with('success', 'Berhasil Menambahkan Data Pengguna');
    }

    public function updateProfile(Request $request)
    {
        $user = User::where("id", auth()->user()->id)->first();
        $dataUser = DataUser::where('user_id', auth()->user()->id)->first();
        $list = ['username', 'address', 'telephone'];
        for ($i = 0; $i < count($list); $i++) {
            if ($request->file('photo_profile')) {
                $validated = $request->validate([
                    'name' => 'required|min:5|max:15',
                    'email' => 'required|email',
                    'username' => 'required|min:5|',
                    'address' => 'required',
                    'photo_profile' => 'required|file|max:2048|dimensions:ratio=1/1|mimes:jpg,png,jpeg',
                    'telephone' => 'numeric|min:11'
                ], [
                    'photo_profile.dimensions' => 'The photo profile field has invalid image dimensions. required 1/1'
                ]);
                Storage::delete($dataUser->photo_profile);
                $path = $validated['photo_profile']->storeAs('photo-profile', rand(1, 1000000) . '-' . $validated['photo_profile']->getClientOriginalName());
                $user->name = $validated["name"];
                $user->email = $validated["email"];
                $user->save();
                $dataUser[$list[$i]] = $validated[$list[$i]];
                $dataUser->photo_profile = $path;
                $dataUser->status = true;
                $dataUser->save();
            } else {
                $validated = $request->validate([
                    'name' => 'required|min:5|max:15',
                    'email' => 'required|email',
                    'username' => 'required|min:5|',
                    'address' => 'required',
                    'telephone' => 'numeric|min:11'
                ]);
                $user->name = $validated["name"];
                $user->email = $validated["email"];
                $user->save();
                $dataUser[$list[$i]] = $validated[$list[$i]];
                $dataUser->status = true;
                $dataUser->save();
            }
        }

        return redirect()->route('dashboard.profile')->with('success', 'Data Pengguna Berhasil Diubah');
    }
}
