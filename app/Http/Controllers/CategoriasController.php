<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::paginate(2);

        return view('categorias.vista', compact('categorias'));
    }

    public function insertar(Request $request)
    {
        $objcategoriaA = new Categoria();
        $nombre = $request->input('nombre');
        try {
            $objcategoriaA->nombre = $nombre;
            $objcategoriaA->save();
            return redirect()->back()->with('mgs', 'Felidades...');
        } catch (Exception $e) {
            return redirect()->back()->with('mgs', 'Error...');
        }
    }
    public function actualizar(Request $request, $id)
    {
       /*  return response()->json($request->all()); */
            try {
                $objcategoriaB = Categoria::find($id);
                $objcategoriaB->nombre = $request->input('nombre');
                $objcategoriaB->save();
                return response()->json(['msg'=>'excelente']);
            } catch (Exception $e) {
                return response()->json(['msg'=>'Paso algo en la actualizacion']);
            }
       
    }
    public function actualizarFormulario($id)
    {
        $categoriaId = Categoria::find($id);
        return response()->json($categoriaId);
    }
    public function borrar($id)
    {

        try{
            $categoriaId = Categoria::find($id);
            $categoriaId->delete();
            return response()->json(['msg'=>'excelente']);
        }
        catch(Exception $e){  
            return response()->json(['msg'=>'Paso algo en la actualizacion']);
        }
    }
}
