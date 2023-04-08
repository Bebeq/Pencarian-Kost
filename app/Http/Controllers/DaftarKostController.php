<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\KostGambar;
use Illuminate\Http\Request;

class DaftarKostController extends Controller
{
    public function index()
    {
        return view('daftar-kost');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'kontak_pemilik' => 'required',
            'harga' => 'required',
        ]);
        $image = $request->validate([
            'name_gambar.*' => 'image|file|max:2048'
        ]);
        if (!$request->hasfile('name_gambar')) {
            return redirect()->back()->withErrors(['message' => 'Kamu harus mengupload gambar kost.']);
        }
        $image_names = [];
        // loop through images and save to /uploads directory
        foreach ($request->file('name_gambar') as $image) {
            $name = $validate['nama'] . date('mdYHis') . uniqid() . "." . $image->getClientOriginalExtension();;
            $image->move(public_path() . '/img/gambar-kost/', $name);
            $image_names[] = $name;
        }
        $create_kost = Kost::create($validate);
        foreach ($image_names as $image) {
            $post = new KostGambar();
            $post->kost_id = $create_kost->id;
            $post->nama = $image;
            $post->save();
        }
        return redirect()->route('daftar-kost.index')->with('success', 'Kost berhasil diajukan, kami akan memverifikasi pengajuan dan akan menginformasikan setelah pengajuan diterima.');
    }
}
