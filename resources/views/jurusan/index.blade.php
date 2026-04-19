@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')
<div class="card border-0 shadow-sm" data-aos="fade-up">
    <div class="card-header bg-transparent d-flex justify-content-between align-items-center flex-wrap gap-3">
        <span class="fw-semibold"><i class="fas fa-building me-2 text-primary"></i> Data Jurusan</span>
        <div class="d-flex gap-2">
            <form method="GET" action="{{ route('jurusan.index') }}" class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari jurusan..." value="{{ request('search') }}">
            </form>
            <a href="{{ route('jurusan.create') }}" class="btn btn-primary rounded-pill px-4">
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
                        <th width="30%">Nama Jurusan</th>
                        <th width="15%">Akreditasi</th>
                        <th width="15%">Total Mahasiswa</th>
                        <th width="15%">Total Matakuliah</th>
                        <th width="12%">Tanggal</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusans as $jurusan)
                    <tr>
                        <td>{{ $jurusan->id_jurusan }}</td>
                        <td class="fw-semibold">{{ $jurusan->nama_jurusan }}</td>
                        <td>
                            @php
                                $akreditasi = $jurusan->akreditasi;
                            @endphp
                            @if($akreditasi == 'A')
                                <span class="badge bg-success" style="background: #10b981 !important; color: white !important; padding: 6px 14px; border-radius: 20px; font-weight: 600;">
                                    <i class="fas fa-star me-1"></i> Akreditasi A
                                </span>
                            @elseif($akreditasi == 'B')
                                <span class="badge bg-warning" style="background: #f59e0b !important; color: white !important; padding: 6px 14px; border-radius: 20px; font-weight: 600;">
                                    <i class="fas fa-chart-line me-1"></i> Akreditasi B
                                </span>
                            @elseif($akreditasi == 'C')
                                <span class="badge bg-danger" style="background: #ef4444 !important; color: white !important; padding: 6px 14px; border-radius: 20px; font-weight: 600;">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Akreditasi C
                                </span>
                            @else
                                <span class="badge bg-secondary" style="background: #64748b !important; color: white !important; padding: 6px 14px; border-radius: 20px; font-weight: 600;">
                                    <i class="fas fa-question me-1"></i> Tidak Ada
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info" style="background: #0ea5e9 !important; color: white !important; padding: 6px 12px; border-radius: 20px;">
                                {{ $jurusan->mahasiswas->count() }} Mahasiswa
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-primary" style="background: #4f46e5 !important; color: white !important; padding: 6px 12px; border-radius: 20px;">
                                {{ $jurusan->matakuliahs->count() }} Matakuliah
                            </span>
                        </td>
                        <td>{{ $jurusan->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('jurusan.edit', $jurusan->id_jurusan) }}" class="btn btn-warning btn-sm" style="background: #f59e0b; border: none; color: white; padding: 5px 10px; border-radius: 8px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jurusan.destroy', $jurusan->id_jurusan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="background: #ef4444; border: none; color: white; padding: 5px 10px; border-radius: 8px;" onclick="return confirm('Yakin ingin menghapus jurusan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-building fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted">Belum ada data jurusan</p>
                            <a href="{{ route('jurusan.create') }}" class="btn btn-primary rounded-pill">Tambah Jurusan</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex flex-column align-items-center mt-4">
            @if($jurusans->total() > 0)
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        @if($jurusans->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">« Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $jurusans->previousPageUrl() }}&search={{ request('search') }}">« Previous</a></li>
                        @endif
                        
                        @php
                            $currentPage = $jurusans->currentPage();
                            $lastPage = $jurusans->lastPage();
                            $start = max(1, $currentPage - 1);
                            $end = min($lastPage, $currentPage + 1);
                            
                            if($start > 1) {
                                echo '<li class="page-item"><a class="page-link" href="'.$jurusans->url(1).'&search='.request('search').'">1</a></li>';
                                if($start > 2) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            
                            for($i = $start; $i <= $end; $i++) {
                                if($i == $currentPage) {
                                    echo '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="'.$jurusans->url($i).'&search='.request('search').'">'.$i.'</a></li>';
                                }
                            }
                            
                            if($end < $lastPage) {
                                if($end < $lastPage - 1) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                echo '<li class="page-item"><a class="page-link" href="'.$jurusans->url($lastPage).'&search='.request('search').'">'.$lastPage.'</a></li>';
                            }
                        @endphp
                        
                        @if($jurusans->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $jurusans->nextPageUrl() }}&search={{ request('search') }}">Next »</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next »</span></li>
                        @endif
                    </ul>
                </nav>
                
                <div class="pagination-info mt-2">
                    <i class="fas fa-chart-line"></i> 
                    Menampilkan {{ $jurusans->firstItem() }} - {{ $jurusans->lastItem() }} dari {{ $jurusans->total() }} data
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    let timeout;
    const searchInput = document.querySelector('input[name="search"]');
    if(searchInput) {
        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    }
</script>
@endpush
@endsection