<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - The Total Office</title>
    <!-- Using Bootstrap 5 to match frontend layout structure -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.05);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            border: 1px solid #eaeaea;
        }
        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-logo img {
            max-height: 50px;
        }
        .btn-primary {
            background-color: #383E42;
            border-color: #383E42;
            padding: 10px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #383E42;
            border-color: #0a58ca;
        }
        .form-control:focus {
            border-color: #383E42;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand-logo">
            <!-- Using frontend logo if it exists, otherwise text -->
            <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="Logo" onerror="this.outerHTML='<h3 class=\'text-primary fw-bold\'>TTO Admin</h3>'">
        </div>
        
        <h5 class="text-center mb-4 text-secondary">Sign in to Admin Dashboard</h5>

        @if(session('error'))
            <div class="alert alert-danger p-2 text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label text-muted small">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-muted small">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-muted small" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </form>

        <div class="text-center mt-4 text-muted" style="font-size: 12px;">
            &copy; {{ date('Y') }} The Total Office. All rights reserved.
        </div>
    </div>
</body>
</html>
