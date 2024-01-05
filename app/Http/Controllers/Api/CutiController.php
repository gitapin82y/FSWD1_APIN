<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Http\Resources\CutiResource;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cutis = Cuti::all();
        return CutiResource::collection($cutis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required',
            'tanggal_cuti' => 'required|date',
            'lama_cuti' => 'required|integer',
            'keterangan' => 'nullable',
        ]);

        $cuti = Cuti::create($request->all());

        return new CutiResource($cuti);
    }

}
