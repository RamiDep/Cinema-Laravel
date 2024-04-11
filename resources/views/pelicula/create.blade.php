@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/pelicula')}}" method="post" enctype="multipart/form-data">
    @csrf    
    @include('pelicula.form',['modo'=>'Registrar'])
    </form>
    
</div>
@endsection