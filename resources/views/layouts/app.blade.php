<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Locamob - Gestão de Locação para Imobiliárias</title>
    <link rel="icon" href="{!! asset('assets/images/favicon/favicon-32x32.png') !!}" sizes="32x32">
    <link href="{!! asset('assets/css//materialize.css') !!}" type="text/css" rel="stylesheet">
    <link href="{!! asset('assets/css//style.css') !!}" type="text/css" rel="stylesheet">
    <link href="{!! asset('assets/css/custom/custom.css') !!}" type="text/css" rel="stylesheet">
    <link href="{!! asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') !!}" type="text/css"
          rel="stylesheet">
    <link href="{!! asset('assets/vendors/flag-icon/css/flag-icon.min.css') !!}" type="text/css" rel="stylesheet">
</head>
<body>
{{--<div id="loader-wrapper">--}}
{{--    <div class="loader-section section-left"></div>--}}
{{--    <div class="loader-section section-right"></div>--}}
{{--</div>--}}
<header id="header" class="page-topbar">
    <div class="navbar-fixed">
        <nav class="navbar-color gradient-45deg-light-blue-cyan">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h1 class="logo-wrapper">
                            <a href="#" class="brand-logo darken-1" style="padding-top: 30px">
                                <span class="logo-text hide-on-med-and-down">Locamob</span>
                            </a>
                        </h1>
                    </li>
                </ul>
                <div class="header-search-wrapper hide-on-med-and-down">
                    <i class="material-icons">search</i>
                    <input type="text" name="Search" class="header-search-input z-depth-2"
                           placeholder="Buscar em locamob"/>
                </div>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="javascript:void(0);" onclick="document.querySelector('form.logout').submit()"
                           class="waves-effect waves-block waves-light profile-button">
                            Sair
                        </a>
                        <form action="{{route('logout')}}" class="logout" method="post" style="display:none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<div id="main">
    <div class="wrapper">
        <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="no-padding">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li class="bold">
                            <a href="{{route('admin.customers.index')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">person</i>
                                <span class="nav-text">Clientes</span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="{{route('admin.owners.index')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">person_add</i>
                                <span class="nav-text">Proprietários</span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="{{route('admin.properties.index')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">store</i>
                                <span class="nav-text">Imóveis</span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="{{route('admin.contracts.index')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">insert_drive_file</i>
                                <span class="nav-text">Contratos</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <a href="#" data-activates="slide-out"
               class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
                <i class="material-icons">menu</i>
            </a>
        </aside>
        <section id="content">
            @yield('content')
        </section>
    </div>
</div>
<script type="text/javascript" src="{!! asset('assets/vendors/jquery-3.2.1.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/js/materialize.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/js/jquery.mask.min.js') !!}"></script>
<script type="text/javascript"
        src="{!! asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/js/plugins.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/js/custom-script.js') !!}"></script>

    @if(session('sucesso'))
        <script type="text/javascript">
                Materialize.toast('{{session('sucesso')}}', 4000);
        </script>
    @endif

@yield('script')
</body>
</html>
