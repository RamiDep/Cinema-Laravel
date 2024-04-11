@extends('layouts.app')
@section('content')
<div class="container">

<a href="{{url('pelicula/create')}}" class="btn btn-success">Agregar pelicula</a>
<br>
<br>

@if(Session::has('mensaje'))
<div class="alert alert-primary alert-dismissible" role="alert" id="miAlerta">
    {{Session::get('mensaje')}} 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="cerrarAlerta()">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<script>
    function cerrarAlerta() {
        var alerta = document.getElementById('miAlerta');
        alerta.style.display = 'none';
    }
</script>



<div class="table-responsive">
    <table class="table table-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Foto</th>
                <th>Url</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peliculas as $pelicula)
                <tr class="">
                    <td>{{ $pelicula->id}}</td>
                    <td>{{ $pelicula->Nombre}}</td>
                    <td>
                        <img src="{{ asset('storage').'/'.$pelicula->Foto}}" alt="" width="80px" height="80px">
                    </td>
                    <td>{{ $pelicula->Url}}</td>
                    <td>
                        <a href="{{url('/pelicula/'.$pelicula->id.'/edit')}}" class="btn btn-warning">Editar</a>

                        <form action="{{url('/pelicula/'.$pelicula->id)}}" method="post">
                            @csrf
                            {{ method_field('DELETE')}}
                            <input type="submit" onclick="return confirm('¿Seguro que quieres eliminar?')" value="Borrar" class="btn btn-danger">
                        </form>

                       <!-- <a href="{{$pelicula->Url}}" class="btn btn-primary">Ver</a>
-->                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
</div>
</div>
@endsection