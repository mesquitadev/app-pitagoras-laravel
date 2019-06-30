<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Faculdade Pitágoras - SGC| Login</title>

    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{asset('/assets/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

</head>

<body class="gray-bg" style=" margin-top: -60px;">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">SGC+</h1>

        </div>
        <h3>Bem vindo ao Sistema de Gerenciamento de Chaves | Faculdade Pitágoras</h3>
        <div class="col-md-12">

        </div>
        <form class="m-t" role="form" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" placeholder="Digite seu email ou usuário" required
                       autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" placeholder="Digite sua senha..." required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"><small> {{ __('Forgot Your Password?') }}</small></a>
            @endif


        </form>
        <p class="m-t"> <small>SGC - Faculdade Pitágoras &copy; 2018 - Todos os direitos Reservados.</small> | Desenvolvido pelo ESC</p>
    </div>
</div>

<!-- Sweet alert -->
<script src="{{asset('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('/assets/js/validate.js')}}"></script>


<script type="text/javascript">

</script>


