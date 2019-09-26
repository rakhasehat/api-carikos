<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\KosResource;
use App\Kos;

class KosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #Semua Data Kos
        $ks = Kos::all();
        return KosResource::collection($ks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #Tambah Data Kos
        $ks = new Kos;
        $this->validate($request, [
            'nama_kos' => 'required',
            'harga_kos' => 'required',
            'no_telp' => 'required',
            'tentang_kos' => 'required',
            'gambar_kos' => 'required'
        ]);

        $ks->nama_kos = $request->input('nama_kos');
        $ks->harga_kos = $request->input('harga_kos');
        $ks->no_telp = $request->input('no_telp');
        $ks->tentang_kos = $request->input('tentang_kos');
        $ks->gambar_kos = $request->input('gambar_kos');
        if($ks->save()){
            return response()->json([
                'message' => 'Berhasil tambah data',
                'data' => $ks
            ], 200);
        }

        return response()->json([
            'message' => 'Gagal tambah data'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
         #Detail Kos
         $ks = Kos::find($id);
         if($ks){
             return response()->json([
                 'message' => 'Sukses menemukan data',
                 'data' => $ks
             ], 200);
         }
         return response()->json([
             'message' => 'Tidak ada data'
         ], 404);
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
        #Update Data Kos
        $ks = Kos::find($id);
        $ks->nama_kos = $request->input('nama_kos');
        $ks->harga_kos = $request->input('harga_kos');
        $ks->no_telp = $request->input('no_telp');
        $ks->tentang_kos = $request->input('tentang_kos');
        $ks->gambar_kos = $request->input('gambar_kos');
        if($ks->save()){
            return response()->json([
                'message' => 'Berhasil update data',
                'data' => $ks
            ], 200);
        }
        return response()->json([
            'message' => 'Gagal edit data'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        #Delete data kos
        $ks = Kos::findOrFail($id);
        if($ks->delete()){
            return response()->json([
                'message' => 'Berhasil menghapus data!'
            ], 201);
        } else{
            return response()->json([
                'message' => 'Gagal menghapus data!'
            ], 404);
        }
    }

    public function search(Request $request)
    {
        $kos_info = Kos::where('nama_kos', 'LIKE', '%'.$request->input('nama_kos').'%')->get();

        if($kos_info){
            return response()->json([
                'status' => 'success',
                'data' => $kos_info
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ditemukan data',
            ], 404);
        }
    }
}
