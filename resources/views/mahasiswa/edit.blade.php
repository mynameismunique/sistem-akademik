@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8" data-aos="fade-up">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent">
                <i class="fas fa-user-edit me-2 text-primary"></i> 
                <span class="fw-semibold">Edit Mahasiswa</span>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nim" class="form-label fw-semibold">NIM</label>
                        <input type="text" 
                               class="form-control @error('nim') is-invalid @enderror" 
                               id="nim" 
                               name="nim" 
                               value="{{ old('nim', $mahasiswa->nim) }}"
                               placeholder="Contoh: 2023001">
                        <small class="text-muted">7 digit angka unik</small>
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="nama" class="form-label fw-semibold">Nama Mahasiswa</label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama', $mahasiswa->nama) }}"
                               placeholder="Contoh: Andi Saputra">
                        @error('nama')
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
                            <option value="{{ $jurusan->id_jurusan }}" {{ old('id_jurusan', $mahasiswa->id_jurusan) == $jurusan->id_jurusan ? 'selected' : '' }}>
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
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection