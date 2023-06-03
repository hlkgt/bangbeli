<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function createTestimoni(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required',
            'description' => 'required|max:200'
        ]);
        Testimoni::insert([
            'user_id' => auth()->user()->id,
            'rate' => $validated["rate"],
            'description' => $validated["description"]
        ]);
        return redirect()->route('dashboard.testimoni')->with('success', 'Testimoni Berhasil Dibuat');
    }
}
