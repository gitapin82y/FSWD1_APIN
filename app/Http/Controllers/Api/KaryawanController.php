<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Http\Resources\KaryawanResource;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        if($request->limit){
            $karyawan = Karyawan::orderBy('tanggal_bergabung', 'asc')->limit($request->limit)->get();
            return KaryawanResource::collection($karyawan);
        }

        $karyawan = Karyawan::all();
        return KaryawanResource::collection($karyawan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
        ]);

        $karyawan = Karyawan::create($request->all());

        return new KaryawanResource($karyawan);
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return new KaryawanResource($karyawan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($request->all());

        return new KaryawanResource($karyawan);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return response()->json(['message' => 'Karyawan deleted successfully']);
    }

    public function onCuti()
    {
        $karyawanOnCuti = Karyawan::whereHas('cuti')->get();
        return KaryawanResource::collection($karyawanOnCuti);
    }

    public function sisaCuti()
    {
        $karyawanSisaCuti = Karyawan::with('cuti')->get();

        $result = $karyawanSisaCuti->map(function ($karyawan) {

            $tahunSekarang = Carbon::now()->year;

            $sisaCuti = $karyawan->cuti->sum('lama_cuti');
    
            $sisaCuti = 12 - $sisaCuti;

            return [
                'nomor_induk' => $karyawan['nomor_induk'],
                'nama' => $karyawan->nama,
                'sisa_cuti' => max(0, $sisaCuti),
            ];
        });

        return $result;
    }
}
