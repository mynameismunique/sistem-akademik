@extends('layouts.app')

@section('title', 'Data Matakuliah')

@section('content')
<div class="card border-0 shadow-sm" data-aos="fade-up">
    <div class="card-header bg-transparent d-flex justify-content-between align-items-center flex-wrap gap-3">
        <span class="fw-semibold"><i class="fas fa-book me-2 text-primary"></i> Manajemen Data Matakuliah</span>
        <div class="d-flex gap-2">
            <form method="GET" action="{{ route('matakuliah.index') }}" class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari matakuliah..." value="{{ request('search') }}">
            </form>
            <a href="{{ route('matakuliah.create') }}" class="btn btn-primary rounded-pill px-4">
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
                        <th width="35%">Nama Matakuliah</th>
                        <th width="10%">SKS</th>
                        <th width="30%">Jurusan</th>
                        <th width="12%">Tanggal</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matakuliahs as $matakuliah)
                    <tr>
                        <td>{{ $matakuliah->id_matakuliah }}</td>
                        <td class="fw-semibold">{{ $matakuliah->nama_matakuliah }}</td>
                        <td>
                            @php
                                if($matakuliah->sks == 1) $badgeColor = 'bg-info';
                                elseif($matakuliah->sks == 2) $badgeColor = 'bg-success';
                                elseif($matakuliah->sks == 3) $badgeColor = 'bg-warning';
                                else $badgeColor = 'bg-danger';
                            @endphp
                            <span class="badge {{ $badgeColor }}">{{ $matakuliah->sks }} SKS</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $matakuliah->jurusan->nama_jurusan ?? '-' }}</span>
                        </td>
                        <td>{{ $matakuliah->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('matakuliah.edit', $matakuliah->id_matakuliah) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('matakuliah.destroy', $matakuliah->id_matakuliah) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus matakuliah ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted">Belum ada data matakuliah</p>
                            <a href="{{ route('matakuliah.create') }}" class="btn btn-primary rounded-pill">Tambah Matakuliah</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- PAGINATION - HANYA SATU, RAPI & KECIL -->
        <div class="d-flex flex-column align-items-center mt-4">
            @if($matakuliahs->total() > 0)
                <!-- Pagination Links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        {{-- Previous Button --}}
                        @if($matakuliahs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">« Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $matakuliahs->previousPageUrl() }}&search={{ request('search') }}" rel="prev">« Previous</a>
                            </li>
                        @endif
                        
                        {{-- Pagination Elements --}}
                        @php
                            $currentPage = $matakuliahs->currentPage();
                            $lastPage = $matakuliahs->lastPage();
                            $start = max(1, $currentPage - 1);
                            $end = min($lastPage, $currentPage + 1);
                            
                            if($start > 1) {
                                echo '<li class="page-item"><a class="page-link" href="'.$matakuliahs->url(1).'&search='.request('search').'">1</a></li>';
                                if($start > 2) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            
                            for($i = $start; $i <= $end; $i++) {
                                if($i == $currentPage) {
                                    echo '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="'.$matakuliahs->url($i).'&search='.request('search').'">'.$i.'</a></li>';
                                }
                            }
                            
                            if($end < $lastPage) {
                                if($end < $lastPage - 1) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                echo '<li class="page-item"><a class="page-link" href="'.$matakuliahs->url($lastPage).'&search='.request('search').'">'.$lastPage.'</a></li>';
                            }
                        @endphp
                        
                        {{-- Next Button --}}
                        @if($matakuliahs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $matakuliahs->nextPageUrl() }}&search={{ request('search') }}" rel="next">Next »</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next »</span>
                            </li>
                        @endif
                    </ul>
                </nav>
                
                <!-- Info Pagination -->
                <div class="pagination-info mt-2">
                    <i class="fas fa-chart-line"></i> 
                    Menampilkan {{ $matakuliahs->firstItem() }} - {{ $matakuliahs->lastItem() }} dari {{ $matakuliahs->total() }} data
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