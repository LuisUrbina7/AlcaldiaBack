@extends('layouts.plantilla')
@section('titulo')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Usuaros</title>
@endsection
@section('contenido')
<div class="container py-5">
    @if ( session('nombre') )
    <div class="alert alert-success" role="alert">
        <strong>Felicitaciones </strong>
        Nombre y rol modificados..
    </div>
    @endif
    @if ( session('claveIncorrecta') )
    <div class="alert alert-danger" role="alert">
        <strong>Lo siento!</strong> {{ session('claveIncorrecta') }}
    </div>
    @endif
  
    <div class="row justify-content-center">
        <h3>Usuarios registrados..</h3>
        <div class="col-12">
            <div class="table-responsive">

                <table class="table table-striped  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Email</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Usuarios as $usuario)
                            
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->username}}</td>
                            <td>{{$usuario->email}}</td>
                            <td><a href="{{route('usuarios.actualizar.formulario',$usuario->id)}}" class="btn btn-success">Editar</a></td>
                            <td><a href="{{route('usuarios.borrar',$usuario->id)}}" onclick="borrar(this)" class="btn btn-danger">Borrar</a></td>
                        </tr>
                       
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function borrar($url){
        event.preventDefault();
        Swal.fire({
                title: '¿Segur@?',
                text: "Se borrará todo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar!',
                cancelButtonText:'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'GET',
                        url: $url,
                        success: function(response) {
                            if (response.msg == 'Bien') {
                                Swal.fire(
                                    'Excelente',
                                    'Actualizado Correctamente',
                                    'success'
                                )
                                location.reload();
                            } else {
                                Swal.fire(
                                    'Algo ocurrió',
                                    'Inténtalo más tarde..',
                                    'danger'
                                )
                            }
                        }
                    });
                }
            })
    }
</script>
    
@endsection