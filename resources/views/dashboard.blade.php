@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12 mb-4" data-aos="fade-up">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-1 fw-bold">Halo, {{ Auth::user()->name }}! 👋</h4>
                <p class="text-muted mb-0">Selamat datang di Sistem Akademik. Kelola data urusan, mahasiswa, dan mata kuliah dengan mudah.</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-number">{{ \App\Models\Jurusan::count() }}</div>
            <div class="stat-label">Total Jurusan</div>
            <a href="{{ route('jurusan.index') }}" class="btn btn-sm btn-outline-primary mt-3 rounded-pill px-4">
                Kelola <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number">{{ \App\Models\Mahasiswa::count() }}</div>
            <div class="stat-label">Total Mahasiswa</div>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-primary mt-3 rounded-pill px-4">
                Kelola <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-number">{{ \App\Models\Matakuliah::count() }}</div>
            <div class="stat-label">Total Mata Kuliah</div>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-sm btn-outline-primary mt-3 rounded-pill px-4">
                Kelola <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<div class="row mt-2" data-aos="fade-up" data-aos-delay="400">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent">
                <i class="fas fa-chart-simple me-2 text-primary"></i> Ringkasan Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Modul</th>
                                <th>Total Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jurusan</td>
                                <td>{{ \App\Models\Jurusan::count() }}</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Mahasiswa</td>
                                <td>{{ \App\Models\Mahasiswa::count() }}</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Mata Kuliah</td>
                                <td>{{ \App\Models\Matakuliah::count() }}</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection