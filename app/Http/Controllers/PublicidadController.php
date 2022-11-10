<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicidadController extends Controller
{
    public function index()
    {
        $banners = Publicidad::select('id', 'responsable', 'enlace', 'banner', 'fecha')->orderby('id', 'desc')->paginate(3);
        return view('publicidad.principal', compact('banners'));
    }
    public function insertar_vista()
    {
        return view('publicidad.insertar');
    }
    public function insertar(Request $request)
    {
        /* dd($request->all()); */
        $validator  = Validator::make($request->all(), [
            'responsable' => ['required', 'string', 'max:255'],
            'enlace' => ['required', 'string', 'max:255'],
            'banner' => ['required'],
            'fecha' => ['required'],
            'idUsuario' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator->errors()]);
        }
        if ($request->hasFile('banner')) {
            $foto = $request->file('banner');
            $destino = 'publicidad_img/';
            $fotoNombre = time() . '-' . $foto->getClientOriginalName();
            $mover = $request->file('banner')->move($destino, $fotoNombre);
        }
        try {
            Publicidad::create([
                'responsable' => $request->input('responsable'),
                'enlace' => $request->input('enlace'),
                'banner' => $destino . $fotoNombre,
                'fecha' => $request->input('fecha'),
                'idUsuario' => $request->input('idUsuario'),
            ]);
            return redirect()->back()->with('success', 'excelente publicidad subida.');
        } catch (Exception $e) {
            return redirect()->back()->with('danger', 'inténtalo de nuevo más tarde.');
        }
    }
    public function actualizar_vista($id)
    {
        $publicidad = Publicidad::find($id);
       
       return view('publicidad.actualizar', compact('publicidad'));
    }
    public function actualizar(Request $request, $id)
    {
       /*  dd($request->all()); */
        try {
            $publicidad = Publicidad::find($id);
            $publicidad->responsable = $request->input('responsable');
            $publicidad->enlace = $request->input('enlace');
            if ($request->hasFile('banner')) {
                $base = public_path($publicidad->banner);
                unlink($base);
                $foto = $request->file('banner');
                $destino = 'publicidad_img/';
                $fotoNombre = time() . '-' . $foto->getClientOriginalName();
                $mover = $request->file('banner')->move($destino, $fotoNombre);
                $publicidad->banner = $destino . $fotoNombre;

            }
            $publicidad->fecha = $request->input('fecha');
            $publicidad->update();
            return redirect()->back()->with('success', 'excelente publicidad actualizada.');
        } catch (Exception $e) {
            return redirect()->back()->with('danger', 'inténtalo de nuevo más tarde.');
        }
    }
    public function borrar($id)
    {
        try{
            $publicidad = Publicidad::find($id);
            $publicidad->delete();
            $base = public_path($publicidad->banner);
            if(file_exists($base)){
                  unlink($base);
                }
                return response()->json(['msg'=>'bien']);
        }catch(Exception $e){
            return response()->json(['msg'=>'error']);

        }
       
    }
}
