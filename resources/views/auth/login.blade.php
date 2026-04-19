<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        }
        
        .login-logo {
            width: 70px;
            height: 70px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 40px;
        }
        
        .login-logo i {
            font-size: 35px;
            color: white;
        }
        
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
        }
        
        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(79,70,229,0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card" data-aos="fade-up" data-aos-duration="1000">
                    <div class="login-logo">
                            <img src="https://webutama.utb-univ.ac.id/storage/uploads/images/254721151_utb_kotak.png" width="120px" alt="Logo" class="login-logo-img">
                    </div>
                    <h3 class="text-center fw-bold mb-2">Sistem Akademik</h3>
                    <p class="text-center text-muted mb-4">Silakan login untuk melanjutkan</p>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="••••••••">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-login w-100 text-white">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                        <div class="text-center mt-3">
                            <a href="{{ route('register') }}" class="text-decoration-none" style="color: #4f46e5;">Belum punya akun? Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>