<?php

namespace App\Http\Controllers;

use App\Models\pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosPelicula['peliculas'] = pelicula::paginate(5);
        return view('pelicula.index', $datosPelicula);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelicula.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos =[
            'Nombre'=> 'required|string|max:100',
            'Foto' => 'required|max:10000|mimes:jpeg, jpg, png',
            'Url' => 'required|string'   
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);
        //$datosPelicula = request()->all();
        $datosPelicula = request()->except('_token');

        if($request->hasFile('Foto'))
        {
            $datosPelicula['Foto']=$request->file('Foto')->store('uploads','public');
        }

        pelicula::insert($datosPelicula);
        
        //return response()->json($datosPelicula);
       return redirect('pelicula')->with('mensaje','Agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(pelicula $pelicula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelicula = pelicula::findOrFail($id);
        return view('pelicula.edit', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos =[
            'Nombre'=> 'required|string|max:100',
            'Url' => 'required|string'   
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            
        ];

        if($request->hasFile('Foto'))
        {
            $mensaje=[
                'Foto.required' => 'La foto es requerida'
            ];
            $campos = [
                'Foto' => 'required|max:10000|mimes:jpeg, jpg, png',
            ];
        }

        $this->validate($request, $campos, $mensaje);



        //
        $datosPelicula = request()->except(['_token','_method']);

        if($request->hasFile('Foto'))
        {
            $pelicula = pelicula::findOrFail($id);
            Storage::delete('public/'.$pelicula->Foto);
            $datosPelicula['Foto']=$request->file('Foto')->store('uploads','public');
        }

        pelicula :: where('id', '=', $id) -> update($datosPelicula);
        
        $pelicula = pelicula::findOrFail($id);
        //return view('pelicula.edit', compact('pelicula'));
        return redirect('pelicula')->with('mensaje','Modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = pelicula::findOrFail($id);
        if(Storage::delete('public'.'/'.$pelicula->Foto))
        {
            pelicula::destroy($id);
        }
        
        return redirect('pelicula')->with('mensaje','Eliminado con éxito');
    }
}
