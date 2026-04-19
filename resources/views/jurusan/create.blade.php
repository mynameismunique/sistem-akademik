@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8" data-aos="fade-up">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent">
                <i class="fas fa-plus-circle me-2 text-primary"></i> 
                <span class="fw-semibold">Tambah Jurusan Baru</span>
            </div>
            <div class="card-body">
                <form action="{{ route('jurusan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama_jurusan" class="form-label fw-semibold">Nama Jurusan</label>
                        <input type="text" 
                               class="form-control @error('nama_jurusan') is-invalid @enderror" 
                               id="nama_jurusan" 
                               name="nama_jurusan" 
                               value="{{ old('nama_jurusan') }}"
                               placeholder="Contoh: Teknik Informatika">
                        @error('nama_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="akreditasi" class="form-label fw-semibold">Akreditasi</label>
                        <select class="form-select @error('akreditasi') is-invalid @enderror" 
                                id="akreditasi" 
                                name="akreditasi">
                            <option value="">Pilih Akreditasi</option>
                            <option value="A" {{ old('akreditasi') == 'A' ? 'selected' : '' }}>A (Unggul)</option>
                            <option value="B" {{ old('akreditasi') == 'B' ? 'selected' : '' }}>B (Baik Sekali)</option>
                            <option value="C" {{ old('akreditasi') == 'C' ? 'selected' : '' }}>C (Baik)</option>
                        </select>
                        @error('akreditasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection