<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function index($id)
    {
        $kost = Kost::find($id);
        if ($kost->verifikasi == 1) {
            return view('details', [
                'kost' => $kost
            ]);
        } else {
            abort(404);
        }
    }
}
