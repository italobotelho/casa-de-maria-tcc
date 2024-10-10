<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Casa de Maria</title>

    <!-- Link para o arquivo CSS de estilos personalizados da página de login -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card shadow-lg border border-0" style="border-radius: 1rem; background-color: #E5D5C0;">
                    <div class="row g-0">
                        <div class="d-flex col-md-6 col-lg-5 d-md-block">
                            <img src="img/logo.png" alt="Logo Casa de Maria" class="img-fluid" style="background-color: rgb(201, 156, 101, 0.5); border-radius: 1rem 0 0 1rem;">
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="d-flex justify-content-center mb-3 pb-1">
                                        <h1 style="color: #795127;">SEU LOGIN</h1>
                                    </div>
            
                                    <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                                        <input id="email" type="email" class="form-control form-control-lg rounded-pill shadow-sm border border-0 @error('email') is-invalid @enderror"
                                        style="background-color: rgb(255, 255, 255, 0.5);" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-MAIL">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
            
                                    <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                                        <input id="password" type="password" class="form-control form-control-lg rounded-pill shadow-sm border border-0 @error('password') is-invalid @enderror" style="background-color: rgb(255, 255, 255, 0.5);" name="password" required autocomplete="current-password" placeholder="SENHA">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
            
                                    <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Lembrar-Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="mb-4 d-grid gap-2 col-6 mx-auto">
                                        <button type="submit" class="btn btn-lg rounded-pill shadow-sm" style="background-color: rgb(138, 99, 58); color: white;">
                                            {{ __('LOGIN') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
<!-- Link para o JavaScript do Bootstrap a partir de uma CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</html>