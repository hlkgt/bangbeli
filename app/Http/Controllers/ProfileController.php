<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function postProfile(Request $request)
    {
        $user = User::where("id", auth()->user()->id)->first();
        $dataUser = DataUser::where('user_id', auth()->user()->id)->first();
        $messages = '';
        if ($dataUser->status !== 1) {
            $validated = $request->validate([
                'username' => 'required|min:5|',
                'address' => 'required',
                'photo_profile' => 'required',
                'telephone' => 'numeric|min:11'
            ]);
            $dataUser->username = $validated["username"];
            $dataUser->address = $validated["address"];
            $dataUser->photo_profile = $validated["photo_profile"];
            $dataUser->telephone = $validated["telephone"];
            $dataUser->status = true;
            $dataUser->save();
            $messages = "Berhasil Memposting Data";
        } else {
            $validated = $request->validate([
                'name' => 'required|min:5|max:15',
                'email' => 'required|email',
                'username' => 'required|min:5|',
                'address' => 'required',
                'photo_profile' => 'required',
                'telephone' => 'numeric|min:11'
            ]);
            $user->name = $validated["name"];
            $user->email = $validated["email"];
            $user->save();
            $dataUser->username = $validated["username"];
            $dataUser->address = $validated["address"];
            $dataUser->photo_profile = $validated["photo_profile"];
            $dataUser->telephone = $validated["telephone"];
            $dataUser->status = true;
            $dataUser->save();
            $messages = "Berhasil Merubah Profile";
        }

        return redirect()->route('dashboard.profile')->with('success', $messages);
    }
}
