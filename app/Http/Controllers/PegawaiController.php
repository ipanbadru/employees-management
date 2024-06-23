<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return response()->json([
                'message' => 'success',
                'pegawai' => Pegawai::latest()->get()
            ]);
        }
        return view('pegawai.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PegawaiRequest $request)
    {
        $foto = null;
        if($request->hasFile('foto')){
            $foto = $request->file('foto')->store('foto-pegawai');
        }
        $pegawai = Pegawai::create([
            ...$request->validated(),
            'foto' => $foto
        ]);

        return response()->json([
            'message' => 'Pegawai berhasil di tambahkan',
            'data' => $pegawai
        ], 201);
    }

    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        $foto = $pegawai->foto;
        if($request->hasFile('foto')){
            if($foto){
                Storage::delete($foto);
            }
            $foto = $request->file('foto')->store('foto-pegawai');
        }

        $pegawai->update([
            ...$request->validated(),
            'foto' => $foto
        ]);

        return response()->json([
            'message' => 'Pegawai berhasil di ubah',
            'data' => $pegawai
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if($pegawai->foto){
            Storage::delete($pegawai->foto);
        }
        $pegawai->delete();
        
        return response()->json(['message' => 'Pegawai berhasil di hapus'], 200);
    }
}
