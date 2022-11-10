@extends('layouts.plantilla')
@section('titulo')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Banners</title>
@endsection
@section('contenido')
<div class="container py-5">
    @if ( session('nombre') )
    <div class="alert alert-success" role="alert">
        <strong>Felicitaciones </strong>
        Banner modificado..
    </div>
    @endif
    @if ( session('claveIncorrecta') )
    <div class="alert alert-danger" role="alert">
        <strong>Lo siento!</strong> {{ session('claveIncorrecta') }}
    </div>
    @endif
  
    <div class="row justify-content-center">
        <h3> Publicidad registrada.</h3>
        <div class="col-12">
            <div class="table-responsive">

                <table class="table table-striped  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Enlace</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach ( $banners as $banner)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$banner->responsable}}</td>
                            <td>{{$banner->enlace}}</td>
                            <td><img src="{{$banner->banner}}" alt="foto" width="100px" height="100px"> </td>
                            <td>{{$banner->fecha}}</td>
                            <td><a href="{{ route('publicidad.actualizar.formulario',$banner->id)}}" class="btn btn-success"><i class="las la-eye"></i></a></td>
                            <td><a href="{{ route('publicidad.borrar',$banner->id)}}" onclick="borrar(this)" class="btn btn-danger"><i class="las la-trash-alt"></i></a></td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                        {{ $banners->links() }}
                    </div>
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
                            console.log(response);
                            if (response.msg=='bien') {
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