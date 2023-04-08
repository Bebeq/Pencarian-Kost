<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return view('main', [
                'kosts' => Kost::latest()->where('verifikasi', 1)->where('nama', 'like', "%" . $request->search . "%")->paginate(20)->withQueryString()
            ]);
        } else {
            return view('main', [
                'kosts' => Kost::latest()->where('verifikasi', 1)->paginate(20)
            ]);
        }
    }
}
