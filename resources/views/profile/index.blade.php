@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <h4 class="profile-name">{{ $user->name }}</h4>
            <p class="profile-email">{{ $user->email }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary rounded-pill px-4">
                <i class="fas fa-edit me-1"></i> Edit Profile
            </a>
        </div>
    </div>
    
    <div class="col-md-8 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="profile-info-card">
            <h5 class="mb-3 fw-semibold"><i class="fas fa-info-circle me-2 text-primary"></i> Informasi Akun</h5>
            
            <div class="profile-info-item">
                <span class="profile-info-label">Nama Lengkap:</span>
                <span class="profile-info-value">{{ $user->name }}</span>
            </div>
            
            <div class="profile-info-item">
                <span class="profile-info-label">Email:</span>
                <span class="profile-info-value">{{ $user->email }}</span>
            </div>
            
            <div class="profile-info-item">
                <span class="profile-info-label">Bergabung Sejak:</span>
                <span class="profile-info-value">{{ $user->created_at->format('d F Y') }}</span>
            </div>
            
            <div class="profile-info-item">
                <span class="profile-info-label">Terakhir Update:</span>
                <span class="profile-info-value">{{ $user->updated_at->format('d F Y H:i') }}</span>
            </div>
        </div>
        
        <div class="profile-info-card mt-3" data-aos="fade-up" data-aos-delay="200">
            <h5 class="mb-3 fw-semibold"><i class="fas fa-lock me-2 text-primary"></i> Ubah Password</h5>
            
            <form action="{{ route('profile.change-password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning rounded-pill px-4">
                    <i class="fas fa-key me-1"></i> Ubah Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection