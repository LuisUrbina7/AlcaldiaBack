@extends('layouts.plantilla')
@section('titulo')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Categoria</title>
@endsection

@section('contenido')
<section>

    <div class="container">
        <div class="categorias-todos bg-light border">
            <div class="row p-md-4 justify-content-center">
                @if (session('msg'))
                <div class="alert alert-primary" role="alert" id="alerta">
                    {{session('msg')}}
                </div>
                @endif
                <h4 class="text-muted text-center"> Categorias <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"> + Agregar</a></h4>
                <div class="col-md-10 ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Borrar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categorias as $categoria )
                            <tr>
                                <th scope="row">{{$categoria->id}}</th>
                                <td>{{$categoria->nombre}}</td>
                                <td><button value="{{route('categoria.actualizar.formulario',$categoria->id)}}" class="btn btn-primary bottom"></button></td>
                                <td><a href="{{route('categoria.borrar',$categoria->id)}}" class="btn btn btn-danger"></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $categorias->links() }}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row border mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="referencia-nombre" class="form-label">Actualizar</label>
                            <input type="text" id="id" name="id">
                            <input type="text" name="referencia-nombre" class="form-control" id="nombre">
                        </div>
                        <div class="col-md-12 mb-3 text-end">
                            <a class="btn btn-warning" id="btn-actualizar">Actualzar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('categoria.insertar')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="form-label">Categoria</label>
                            <input type="text" name="nombre" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.bottom', function() {
        var ruta = $(this).val();
        $('#id').val('');
        $('#nombre').val('');
        $.ajax({
            type: 'GET',
            url: ruta,
            dataType: 'json',
            success: function(response) {

                $('#id').val(response['id']);
                $('#nombre').val(response['nombre']);

            },
            error: function(response) {
                console.log('errorr ago mal');
            }
        });
    });

    $('#btn-actualizar').click(function(e) {
        e.preventDefault();
        let rutaActualizar = '{{route("categoria.actualizar.insertar","id")}}';
        let datos = {
            nombre: $('#nombre').val()
        };
        let id = $('#id').val();
        rutaActualizar = rutaActualizar.replace('id', id);
        /*  console.log(id);
         console.log(rutaActualizar); */

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: rutaActualizar,
            data: datos,
            dataType: 'json',
            success: function(response) {
                console.log(response.msg);
                if (response.msg == 'excelente') {
                    Swal.fire(
                        'Excelente',
                        'Actualizado Correctamente',
                        'success'
                    )
                    location.reload();
                } else {

                }
            }
        });
    });
</script>

@endsection