@extends('layouts.app')

@section('titulo')
    Tabla
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                scrollY: '50vh',
                scrollCollapse: true,
            });
        });
    </script>
@endpush

@section('contenido')
    <table id="myTable" class="table table-striped " >
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Archivo</th>
            </tr>
        </thead>
        <tbody>
            {{-- Ciclo que iterara n cantidad de veces dependiendo de la cantidad de datos en la base de datos --}}
            @foreach ($formularios as $formulario)
            <tr>
                <td>{{ $formulario->nombre }}</td>
                <td>{{ $formulario->nombre_archivo }}</td>
                <td class="flex flex-row">
                    <button type="submit" class="btn btn-info text-white" onclick="showFile('{{ $formulario->nombre_archivo }}')">Ver</button>
                    <form action="{{ route('formulario.destroy', $formulario) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded  btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        function showFile(nombre_archivo){
            // Realiza una solicitud AJAX a una URL determinada, usando el método GET.
            $.ajax({
                // La URL se construye dinámicamente.
                url: "{{ route('formulario.archivo', '') }}/" + nombre_archivo,
                type: "get",
                dataType: "json",
            }).done(function(res){
                // Si la solicitud AJAX se completa con éxito, abre una nueva pestaña o ventana del navegador
                window.open(res.response.url,'_blank');
            }).fail(function(res){
                // Si la solicitud AJAX falla, registra la respuesta en la consola del navegador.
                console.log(res)
            });
        }
    </script>
@endsection
