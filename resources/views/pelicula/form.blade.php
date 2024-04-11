<h1>{{$modo}} pelicula</h1>

@if(count($errors)>0)
   
    <div class="alert alert-danger" role="alert">
        <ul> 
            @foreach($errors->all() as $error)
            <li>{{ $error}}</li>
            @endforeach
        </ul>   
    </div>
    
@endif    
    

<div class="form-group">
<label for="Nombre">Nombre:</label>
<input class="form-control" type="text" value="{{ isset($pelicula->Nombre)?$pelicula->Nombre:old('Nombre')}}" id="Nombre" name="Nombre">
</div>
<div class="form-group">
<label for="Foto">Foto:</label>
@if(isset($pelicula->Foto))
<img src="{{ asset('storage').'/'.$pelicula->Foto}}" alt="" width="50px" height="50px">
@endif
<input class="form-control" type="file" value="" id="Foto" name="Foto">
</div>
<div class="form-group">
<label for="Url">Link:</label>
<input class="form-control" type="text" value=" {{ isset($pelicula->Url)?$pelicula->Url:old('Url')}}" id="Url" name="Url">
</div>
<br>
<a href="{{url('pelicula/')}}" class="btn btn-success">Regresar</a>
<input type="submit" value="{{$modo}} datos" class="btn btn-primary">