@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="card border-0 shadow-sm" data-aos="fade-up">
    <div class="card-header bg-transparent d-flex justify-content-between align-items-center flex-wrap gap-3">
        <span class="fw-semibold"><i class="fas fa-users me-2 text-primary"></i> Data Mahasiswa</span>
        <div class="d-flex gap-2">
            <form method="GET" action="{{ route('mahasiswa.index') }}" class="search-container" id="searchForm">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari mahasiswa..." value="{{ request('search') }}" id="searchInput">
            </form>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="fas fa-plus me-1"></i> Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="15%">NIM</th>
                        <th width="30%">Nama Mahasiswa</th>
                        <th width="25%">Jurusan</th>
                        <th width="15%">Tanggal</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $mahasiswa)
                    <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 30 }}">
                        <td>{{ $mahasiswa->id_mahasiswa }}</td>
                        <td><code>{{ $mahasiswa->nim }}</code></td>
                        <td class="fw-semibold">{{ $mahasiswa->nama }}</td>
                        <td>
                            <span class="badge bg-primary" style="background: #4f46e5 !important; color: white !important; padding: 6px 12px; border-radius: 20px;">
                                {{ $mahasiswa->jurusan->nama_jurusan ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $mahasiswa->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->id_mahasiswa) }}" class="btn btn-warning btn-sm" style="background: #f59e0b; border: none; color: white; padding: 5px 10px; border-radius: 8px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id_mahasiswa) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="background: #ef4444; border: none; color: white; padding: 5px 10px; border-radius: 8px;" onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted">Belum ada data mahasiswa</p>
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary rounded-pill">Tambah Mahasiswa</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex flex-column align-items-center mt-4">
            @if($mahasiswas->total() > 0)
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        @if($mahasiswas->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">« Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $mahasiswas->previousPageUrl() }}&search={{ request('search') }}">« Previous</a></li>
                        @endif
                        
                        @php
                            $currentPage = $mahasiswas->currentPage();
                            $lastPage = $mahasiswas->lastPage();
                            $start = max(1, $currentPage - 1);
                            $end = min($lastPage, $currentPage + 1);
                            
                            if($start > 1) {
                                echo '<li class="page-item"><a class="page-link" href="'.$mahasiswas->url(1).'&search='.request('search').'">1</a></li>';
                                if($start > 2) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            
                            for($i = $start; $i <= $end; $i++) {
                                if($i == $currentPage) {
                                    echo '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="'.$mahasiswas->url($i).'&search='.request('search').'">'.$i.'</a></li>';
                                }
                            }
                            
                            if($end < $lastPage) {
                                if($end < $lastPage - 1) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                echo '<li class="page-item"><a class="page-link" href="'.$mahasiswas->url($lastPage).'&search='.request('search').'">'.$lastPage.'</a></li>';
                            }
                        @endphp
                        
                        @if($mahasiswas->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $mahasiswas->nextPageUrl() }}&search={{ request('search') }}">Next »</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next »</span></li>
                        @endif
                    </ul>
                </nav>
                
                <div class="pagination-info mt-2">
                    <i class="fas fa-chart-line"></i> 
                    Menampilkan {{ $mahasiswas->firstItem() }} - {{ $mahasiswas->lastItem() }} dari {{ $mahasiswas->total() }} data
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    
    if(searchInput) {
        searchInput.addEventListener('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });
    }
</script>
@endpush
@endsection