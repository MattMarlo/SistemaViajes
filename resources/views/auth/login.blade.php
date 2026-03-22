
<div class="pagetitle mb-4">
<h1 class="fw-bold">Iniciar Sesión</h1>
</div>

<section class="section">
<div class="row justify-content-center">
    <div class="col-12 col-md-6">

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

        <form action="{{ route('login') }}" method="post">
            @csrf

            <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('register') }}" class="text-decoration-none">
                ¿No tienes cuenta? Regístrate
            </a>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>

        </form>

        </div>
    </div>

    </div>
</div>


