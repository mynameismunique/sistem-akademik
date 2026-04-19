@extends('layouts.app')

@section('title', 'Tambah Matakuliah')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8" data-aos="fade-up">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent">
                <i class="fas fa-book-plus me-2 text-primary"></i> 
                <span class="fw-semibold">Tambah Matakuliah Baru</span>
            </div>
            <div class="card-body">
                <form action="{{ route('matakuliah.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama_matakuliah" class="form-label fw-semibold">Nama Matakuliah</label>
                        <input type="text" 
                               class="form-control @error('nama_matakuliah') is-invalid @enderror" 
                               id="nama_matakuliah" 
                               name="nama_matakuliah" 
                               value="{{ old('nama_matakuliah') }}"
                               placeholder="Contoh: Pemrograman Web">
                        @error('nama_matakuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="sks" class="form-label fw-semibold">SKS</label>
                        <select class="form-select @error('sks') is-invalid @enderror" 
                                id="sks" 
                                name="sks">
                            <option value="">Pilih SKS</option>
                            <option value="1" {{ old('sks') == 1 ? 'selected' : '' }}>1 SKS</option>
                            <option value="2" {{ old('sks') == 2 ? 'selected' : '' }}>2 SKS</option>
                            <option value="3" {{ old('sks') == 3 ? 'selected' : '' }}>3 SKS</option>
                            <option value="4" {{ old('sks') == 4 ? 'selected' : '' }}>4 SKS</option>
                        </select>
                        @error('sks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="id_jurusan" class="form-label fw-semibold">Jurusan</label>
                        <select class="form-select @error('id_jurusan') is-invalid @enderror" 
                                id="id_jurusan" 
                                name="id_jurusan">
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id_jurusan }}" {{ old('id_jurusan') == $jurusan->id_jurusan ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }} (Akreditasi {{ $jurusan->akreditasi }})
                            </option>
                            @endforeach
                        </select>
                        @error('id_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection