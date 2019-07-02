<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('assets/img/favicon.png')}}" type="image/x-icon">
    <!-- FooTable -->
    <link href="{{asset('/assets/css/plugins/footable/footable.core.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('/assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/assets/css/card.css')}}">
    <!-- Sweet Alert -->
    <link href="{{asset('/assets/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <script src="{{asset('/assets/js/JsBarcode.ean-upc.min.js')}}"></script>
</head>
<body class="fixed-sidebar skin-1">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                                <img alt="image" src="{{asset('/assets/img/logo-pitagoras.png')}}" style=" width:
                                50px;" />
                                 </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"><span class="block m-t-xs">
                                        <strong class="font-bold">
                                            {{auth()->user()->name}}
                                        </strong>
                                 </span>
                        </a>
                    </div>
                </li>


                <li class="">
                    <a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span
                                class="nav-label">Dashboard</span></a>
                </li>

                <li class="">

                    <a class=""><i class="fa fa-key"></i> <span class="nav-label">Chaves</span> <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">
                        <li class="">
                            <a href="{{route('key.index')}}">Listar</a>
                        </li>


                        <li class="">
                            <a href="{{route('request.create')}}">Solicitar</a>
                        </li>

                        <li class="">
                            <a href="">Devolver Chave</a>
                        </li>

                        <li class="">
                            <a href="{{route('request-user.index')}}">Solicitantes</a>
                        </li>
                    </ul>
                </li>


                <li class="">
                    <a href=""><i class="fa fa-files-o"></i> <span class="nav-label">Relatórios</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class=""><a href="">Logs</a></li>
                    </ul>
                </li>

                <li class="">

                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Configurações</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class=""><a href="">Backup</a></li>


                        <li class=""><a href="">Permissões</a></li>

                        <li class=""><a href="">Usuários</a></li>


                        <li class=""><a href="{{route('sector.index')}}">Setores</a></li>

                    </ul>
                </li>

                <li class="">
                    <a href=""><i class="fa fa-user"></i> <span class="nav-label">Perfil</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Bem vindo ao SGC - Gerenciamento de Chaves.</span>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>

            </nav>
        </div>


        @yield('content')


        <div class="footer fixed">
            <div class="pull-right">
                Desenvolvido pelo <strong>ESC</strong>
            </div>
            <div>
                <strong>SGC - Faculdade Pitágoras</strong> &copy; 2018 - Todos os direitos Reservados.
            </div>
        </div>

        <script type='text/javascript'>
            JsBarcode(".barcode").init();
        </script>
        <!-- Mainly scripts -->
        <script src="{{asset('/assets/js/jquery-2.1.1.js')}}"></script>
        <script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
        <script src="{{asset('/assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- Sweet alert -->
        <script src="{{asset('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
        <!-- Custom and plugin javascript -->
        <script src="{{asset('/assets/js/inspinia.js')}}"></script>
        <script src="{{asset('/assets/js/plugins/pace/pace.min.js')}}"></script>
        <script src="{{asset('/assets/js/plugins/dataTables/datatables.min.js')}}"></script>
        <!-- jQuery UI -->
        <script src="{{asset('/assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>


        <!-- Toastr -->
        <script src="{{asset('/assets/js/plugins/toastr/toastr.min.js')}}"></script>

        <!-- FooTable -->
        <script src="{{asset('/assets/js/plugins/footable/footable.all.min.js')}}"></script>
        <script src="{{asset('/assets/js/html2canvas.js')}}"></script>
        <script src="{{asset('/assets/js/jquery.mask.js')}}"></script>
        <script src="{{asset('/assets/js/image2canvas.js')}}"></script>
        <script src="{{asset('/assets/js/page-scripts.js')}}"></script>


        @stack('scripts')

        <script type="text/javascript">
            @if(Session::has('message'))
                var type="{{Session::get('alert-type','info')}}";
                switch(type){
                    case 'info':
                        swal("Info!", "{{Session::get('message')}}", "info");
                        setTimeout(function(){ location.reload(); }, 2000);
                        break;
                    case 'success':
                        swal("Sucesso!", "{{Session::get('message')}}", "success");
                        setTimeout(function(){ location.reload(); }, 2000);
                        break;
                    case 'warning':
                        swal("Você tem certeza?", "{{Session::get('message')}}", "warning");
                        setTimeout(function(){ location.reload(); }, 2000);
                        break;
                    case 'error':
                        swal("Erro!", "{{Session::get('message')}}", "error");
                        setTimeout(function(){ location.reload(); }, 2000);
                        break;
                }
            @endif
            // setTimeout(function(){ location.reload(); }, 2000);

            $(document).ready(function() {

                $('.footable').footable();
                $('.footable2').footable();
            });



        </script>


</body>

