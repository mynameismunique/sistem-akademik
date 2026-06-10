<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('jurusan');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhereHas('jurusan', function($q) use ($search) {
                      $q->where('nama_jurusan', 'like', "%{$search}%");
                  });
            });
        }
        
        $mahasiswas = $query->latest()->paginate(5);
        $mahasiswas->appends($request->only('search'));
        
        return view('mahasiswa.index', compact('mahasiswas'));
    }
    
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.create', compact('jurusans'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa|size:11',
            'nama' => 'required|min:3',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);
        
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }
    
    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }
    
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|size:11|unique:mahasiswa,nim,' . $id . ',id_mahasiswa',
            'nama' => 'required|min:3',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);
        
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function print()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        return view('mahasiswa.print', compact('mahasiswa'));
    }

    public function exportExcel()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        return response()
            ->view('mahasiswa.excel', compact('mahasiswa'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=mahasiswa.xls');
    }
}