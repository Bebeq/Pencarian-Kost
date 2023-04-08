<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kost_id' => 'required|numeric',
            'rating' => 'required',
            'komentar' => 'required|max:500'
        ]);
        $get_user = auth()->user()->id;
        $validate['user_id'] = $get_user;
        Review::create($validate);

        return redirect()->route('details', $validate['kost_id'])->with('success', 'Komentar telah ditambahkan.');
    }
}
