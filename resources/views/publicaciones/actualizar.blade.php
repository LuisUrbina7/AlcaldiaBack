@extends('layouts.plantilla')
@section('titulo')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Publicacion</title>
@endsection
@section('contenido')
<section class="p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Blog / actualizar</h1>
                <div class="border rounded">
                    @if ( session('success') )
                    <div class="alert alert-success" role="alert">
                        <strong>Felicitaciones </strong>
                        Actualizado correctamente..
                    </div>
                    @endif
                    @if ( session('danger') )
                    <div class="alert alert-danger" role="alert">
                        <strong>Error</strong>
                      Algo esta mal..
                    </div>
                    @endif
                    <h3 class="text-muted text-center pt-4 ">BORRAR <a href="#" class="btn btn-danger" id="btn-publicacion-borrar">-</a> </h3>
                    <input value="{{ route('publicar.borrar',$busqueda->id)}}" type="hidden" id="input-publicacion-borrar">
                    <form action="{{route('publicaciones.actualizar.insertar',$busqueda->id)}}" method="post" enctype="multipart/form-data">
                        @csrf


                        <input type="hidden" value=" {{ Auth::user()->id }}" name="idUsuario">
                        <div class="row m-3">
                            <div class="col-12">
                                <label for="titulo" class="form-label">Ingresa el titulo.</label>
                                <input type="text" name="titulo" class="form-control" value="{{$busqueda->titulo}}">
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-md-6">
                                <label for="categoria" class="form-label">Categoria:</label>
                                <select id="categoria" class="form-select" name="categoria"  aria-selected="{{$busqueda->categoria}}">
                                    <option value="{{$busqueda->categoria}}">---seleccione---.</option>
                                    @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                                <input type="file" name="foto" id="foto" class="form-control mt-3">
                            </div>
                            <div class="col-md-6">
                                <label for="sinopsis" class="form-label">Sinopsis:</label>
                                <textarea name="sinopsis" id="" cols="30" rows="3" class="form-control">{{$busqueda->sinopsis}}</textarea>
                            </div>
                        </div>
                        <div class="row m-12">
                            <div class="col-md-12 text-center">
                                <img src="http://localhost/AlcaldiaBack/public/{{$busqueda->img}}" alt="Foto" width="231px" height="200px">
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-md-12">
                                <label for="detalles" class="form-label">Descripcion:</label>
                                <textarea name="detalles" id="editor" cols="30" rows="10" class="form-control">{{$busqueda->detalles}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <input type="submit" value="Actualizar" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>






@endsection

@section('js')
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    $(document).ready(function() {
        $('#btn-publicacion-borrar').on('click', function() {
            let borrar_id = $('#input-publicacion-borrar').val();
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
                        url: borrar_id,
                        dataType: 'json',
                        success: function(response) {
                            if (response.msg == 'Bien') {
                                Swal.fire(
                                    'Excelente',
                                    'Actualizado Correctamente',
                                    'success'
                                )
                                location.reload('/publicacion');
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
        });
    });
</script>
@endsection