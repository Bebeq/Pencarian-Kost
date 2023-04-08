<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminKostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return view('admin/kost/index', [
                'kosts' => Kost::latest()->where('verifikasi', 1)->where('nama', 'like', "%" . $request->search . "%")->paginate(5, ['*'], 'page_kost')->withQueryString(),
                'kosts_unverif' => Kost::latest()->where('verifikasi', 0)->where('nama', 'like', "%" . $request->search . "%")->paginate(5, ['*'], 'page_kost_unverif')->withQueryString()
            ]);
        } else {
            return view('admin/kost/index', [
                'kosts' => Kost::latest()->where('verifikasi', 1)->paginate(5, ['*'], 'page_kost')->withQueryString(),
                'kosts_unverif' => Kost::latest()->where('verifikasi', 0)->paginate(5, ['*'], 'page_kost_unverif')->withQueryString()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kost = Kost::find($id);
        if ($kost->verifikasi == 0) {
            return view('admin/kost/show', [
                'kost' => $kost
            ]);
        } else {
            abort(404);
        }
    }

    public function verifikasi(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'kontak_pemilik' => 'required',
            'harga' => 'required',
        ]);
        $validate['verifikasi'] = 1;

        Kost::find($validate['id'])->update($validate);
        return redirect()->route('admin.kost.index')->with('success', 'Kost "' . $validate['nama'] . '" berhasil di verifikasi.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kost = Kost::findOrFail($id);
        $kost->update(['verifikasi' => 2]);
        return redirect()->route('admin.kost.index')->with('success', 'Kost "' . $kost->nama . '" berhasil di hapus.');
    }
}
