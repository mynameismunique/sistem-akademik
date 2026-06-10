<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaApi extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();

        if ($mahasiswa->isEmpty()) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil diambil',
            'result' => $mahasiswa
        ], 200);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Detail data mahasiswa',
            'result' => $mahasiswa
        ], 200);
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'result' => $mahasiswa
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->update($request->all());

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil diupdate',
            'result' => $mahasiswa 
        ], 200);
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus'
        ], 200);
    }
}