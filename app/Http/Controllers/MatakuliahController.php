<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = Matakuliah::with('jurusan');
        
        // Fitur Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_matakuliah', 'like', "%{$search}%")
                  ->orWhere('sks', 'like', "%{$search}%")
                  ->orWhereHas('jurusan', function($q) use ($search) {
                      $q->where('nama_jurusan', 'like', "%{$search}%");
                  });
            });
        }
        
        $matakuliahs = $query->latest()->paginate(5);
        $matakuliahs->appends($request->only('search'));
        
        return view('matakuliah.index', compact('matakuliahs'));  // ← kirim $matakuliahs (jamak)
    }
    
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('matakuliah.create', compact('jurusans'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|min:3',
            'sks' => 'required|integer|min:1|max:4',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);
        
        Matakuliah::create($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('matakuliah.edit', compact('matakuliah', 'jurusans'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matakuliah' => 'required|min:3',
            'sks' => 'required|integer|min:1|max:4',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);
        
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->update($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus');
    }
}