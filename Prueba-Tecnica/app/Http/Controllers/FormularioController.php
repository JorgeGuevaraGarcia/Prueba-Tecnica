<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FormularioController extends Controller
{
    // Redirecciona a la vista para registrar formulario
    public function index(){
        return view('create');
    }

    // Redirecciona a la vista para registrar formulario
    public function create(){
        return view('create');
    }

    // Método para almacenar los datos del formulario en la base de datos
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|max:255', // Nombre requerido y longitud máxima de 255 caracteres
            'nombre_archivo' => 'required|mimes:pdf|max:5000', // Descripción requerida
        ]);

        $archivo = $request->file('nombre_archivo');

        if ($archivo && $archivo->isValid()) {
            $nombreArchivo = $archivo->getClientOriginalName();
            $destino = public_path('/uploads');
            
            // Verifica si el directorio existe y si no, créalo
            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }
    
            $archivo->move($destino, $nombreArchivo);
    
            Formulario::create([
                'nombre' => $request->nombre,
                'nombre_archivo' => $nombreArchivo,
            ]);
        }
        // Redireccionar a la vista de mostrar formulario con un mensaje de éxito
        return redirect()->route('formulario.show')->with('success', 'Archivo subido con éxito');
    }

    // Muestra los datos alamcenados en la vista de show.blade.php
    public function show(){
        $formularios = Formulario::all();

        
        return view('show', ['formularios' => $formularios]);
    }

    //Elimina el contenido de la base de datos con ayuda del id del formulario creado
    public function destroy($id){
        $formulario = Formulario::findOrFail($id);

        // Ruta completa al archivo
        $file_path = public_path('uploads/' . $formulario->nombre_archivo);

        // Verificar si el archivo existe
        if (File::exists($file_path)) {
            // Eliminar el archivo
            File::delete($file_path);
        }
        
        // Eliminar el registro de la base de datos
        $formulario->delete();

        return redirect()->route('formulario.show');
    }

    public function urlArchivo($nombre_archivo){
        $file = Formulario::where('nombre_archivo', $nombre_archivo)->first();
        if($file){
            return response()->json(['response' => [
                'url' => asset('uploads/' . $file->nombre_archivo),
                ]
            ], 200);
        }
        return response()->json(['error' => 'Archivo no encontrado'], 404);
    }
    
}
