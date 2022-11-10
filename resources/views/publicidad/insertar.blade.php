@extends('layouts.plantilla')
@section('titulo')

<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

<title>Publicidad</title>
@endsection
@section('contenido')

<section class="p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Banners / agregar</h1>
               
                <div class="border rounded">
                    @if ( session('success') )
                    <div class="alert alert-success" role="alert">
                        <strong>Felicitaciones </strong>
                        {{session('success')}}
                    </div>
                    @endif
                    @if ( session('danger') )
                    <div class="alert alert-danger" role="alert">
                        <strong>mal </strong>
                        {{session('danger')}}
                    </div>
                    @endif
                    <h3 class="text-muted text-center pt-4 ">Ingreso los datos</h3>
                    <form action="{{route('publicidad.insertar')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value=" {{ Auth::user()->id }}" name="idUsuario">
                        <div class="row m-3">
                            <div class="col-12">
                                <label for="responsable" class="form-label">Responsable:</label>
                                <input type="text" name="responsable" class="form-control" required>
                                @error('responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-md-6">
                                <label for="enlace" class="form-label">enlace:</label>
                                <input type="text" name="enlace" id="enlace" class="form-control" required>
                                @error('enlace')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="banner" class="form-label">Banner:</label>
                                <input type="file" name="banner" class="form-control">
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-md-12">
                                <label for="fecha" class="form-label">Fecha:</label>
                               <input type="date" name="fecha" id="fecha" class="form-control" required>
                               @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <input type="submit" value="Enviar" class="btn btn-primary">
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
   
</script>

@endsection