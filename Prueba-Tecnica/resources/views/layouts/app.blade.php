<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        {{-- Titulo de la pagina --}}
        <title>@yield('titulo')</title>
        
        {{-- Asignación de estilos usando un template --}}
        @stack('styles')
        <link rel="stylesheet" href="../css/app.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>    
    </head>
    {{-- Cuerpo principal --}}
    <body class="m-0 font-sans text-base antialiased font-normal leading-default h-full">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand"  href="{{ route('formulario.create')}}">Prueba Técnica</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('formulario.create')}}">Formulario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formulario.show')}}">Ver Tabla</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="min-h-full">
            <main class="container mx-auto mt-10">
                @yield('contenido')
            </main>
        </div>
    </body> 
</html>
