<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Akademik - @yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <div class="app-wrapper">
        <div class="sidebar" id="sidebar">
            <div class="brand">
                <img src="https://webutama.utb-univ.ac.id/storage/uploads/images/2127336430_utb_panjang.png" width="200 px">
            </div>
            <nav class="nav flex-column mt-3">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-chart-line"></i> <span>Dashboard</span>
                </a>
                <a class="nav-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}" href="{{ route('jurusan.index') }}">
                    <i class="fas fa-building"></i> <span>Jurusan</span>
                </a>
                <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                    <i class="fas fa-users"></i> <span>Mahasiswa</span>
                </a>
                <a class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}" href="{{ route('matakuliah.index') }}">
                    <i class="fas fa-book"></i> <span>Mata Kuliah</span>
                </a>

                <hr class="my-3 mx-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-danger" style="background: none; border: none; width: 100%; text-align: left;">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>
        
        <div class="main-content">
            <div class="top-navbar">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="d-flex align-items-center gap-2">
                        <button class="hamburger-btn" id="hamburgerBtn" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <button class="collapse-btn" id="collapseBtn" type="button">
                            <i class="fas fa-chevron-left"></i> <span>Perkecil</span>
                        </button>
                        <h5 class="mb-0 ms-2 d-none d-sm-block">
                            <i class="fas fa-graduation-cap me-2 text-primary"></i> 
                            @yield('title')
                        </h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" style="padding: 8px 20px;">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3">
                            <li><a class="dropdown-item py-2" href="{{ route('profile.index') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="p-3 p-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });
        
        const sidebar = document.getElementById('sidebar');
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const overlay = document.getElementById('sidebarOverlay');
        
        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', openSidebar);
        }
        
        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }
        
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
        
        const collapseBtn = document.getElementById('collapseBtn');
        const collapseIcon = collapseBtn ? collapseBtn.querySelector('i') : null;
        const collapseText = collapseBtn ? collapseBtn.querySelector('span') : null;
        
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        if (isCollapsed && window.innerWidth > 768) {
            sidebar.classList.add('collapsed');
            if (collapseIcon) {
                collapseIcon.classList.remove('fa-chevron-left');
                collapseIcon.classList.add('fa-chevron-right');
            }
            if (collapseText) collapseText.textContent = 'Perbesar';
        }
        
        if (collapseBtn) {
            collapseBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                const collapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', collapsed);
                
                if (collapseIcon) {
                    if (collapsed) {
                        collapseIcon.classList.remove('fa-chevron-left');
                        collapseIcon.classList.add('fa-chevron-right');
                        if (collapseText) collapseText.textContent = 'Perbesar';
                    } else {
                        collapseIcon.classList.remove('fa-chevron-right');
                        collapseIcon.classList.add('fa-chevron-left');
                        if (collapseText) collapseText.textContent = 'Perkecil';
                    }
                }
            });
        }
        
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) closeSidebar();
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>