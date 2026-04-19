<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $query = Jurusan::with(['mahasiswas', 'matakuliahs']);
        
        // Fitur Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_jurusan', 'like', "%{$search}%")
                  ->orWhere('akreditasi', 'like', "%{$search}%");
            });
        }
        
        $jurusans = $query->latest()->paginate(5);
        $jurusans->appends($request->only('search'));
        
        return view('jurusan.index', compact('jurusans'));  // ← hanya kirim $jurusans
    }
    
    public function create()
    {
        return view('jurusan.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|unique:jurusan|min:3',
            'akreditasi' => 'required|in:A,B,C',
        ]);
        
        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('jurusan'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|min:3|unique:jurusan,nama_jurusan,' . $id . ',id_jurusan',
            'akreditasi' => 'required|in:A,B,C',
        ]);
        
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}