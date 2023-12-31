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
            'nombre_archivo' => 'required|mimes:pdf|max:5000', // archivo requerida
        ]);

        $archivo = $request->file('nombre_archivo');

        if ($archivo && $archivo->isValid()) {
            $hashName = $archivo->hashName();  // Se obtiene el hash del nombre del archivo
            $destino = public_path('/uploads');
    
            // Verifica si el directorio existe y si no, créalo
            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }
    
            $archivo->move($destino, $hashName);  // Mueve el archivo usando el hash del nombre del archivo
    
            Formulario::create([
                'nombre' => $request->nombre,
                'nombre_archivo' => $hashName,  // Guarda el hash del nombre del archivo en la base de datos
            ]);
        
        }
        // Redireccionar a la vista de mostrar formulario con un mensaje de éxito
        return redirect()->route('formulario.show')->with('success', 'Archivo subido con éxito');
    }

    // Muestra los datos alamcenados en la el datatable
    public function show(){
        $formularios = Formulario::all();
        return view('show', ['formularios' => $formularios]);
    }

    // Elimina el contenido de la base de datos con ayuda del id del formulario creado
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
        // Busca en la base de datos un registro donde el campo nombre_archivo 
        // coincide con el argumento nombre_archivo proporcionado en showFile(), y obtiene el primer registro que coincida.
        $file = Formulario::where('nombre_archivo', $nombre_archivo)->first();
        // Verifica si se encontró un registro.
        if($file){
            // Si se encontró un registro, devuelve una respuesta JSON con un código de estado 200 (OK).
            // La respuesta incluye una URL generada para acceder al archivo almacenado en el servidor.
            return response()->json(['response' => [
                'url' => asset('uploads/' . $file->nombre_archivo),
                ]
            ], 200);
        }
        // Si no se encontró ningún registro, devuelve una respuesta JSON con un código de estado 404 (Not Found)
        // y un mensaje de error.
        return response()->json(['error' => 'Archivo no encontrado'], 404);
    }
    
}
