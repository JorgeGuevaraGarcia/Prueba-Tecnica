<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FormularioTest extends TestCase
{
    use RefreshDatabase;  // Resetea la base de datos antes de cada prueba.

    /** @test */
    public function a_user_can_submit_a_formulario()
    {
        // Preparación
        Storage::fake('local');  // Se usa un almacenamiento falso para evitar que se suban archivos reales 
        $file = UploadedFile::fake()->create('document.pdf', 200);  // Se crea un archivo falso

        $response = $this->post('/formulario/store', [
            'nombre' => 'John Doe',
            'nombre_archivo' => $file,
        ]);

        // Afirmaciones
        $response->assertRedirect(route('formulario.show'));  // Se agrega el redireccionamiento a la vista de las tablas
        $this->assertDatabaseHas('formularios', [
            'nombre' => 'John Doe',
            'nombre_archivo' => $file->hashName(),  // Se verifica si el archvio se almaceno correctamente
        ]);
        $this->assertFileExists(public_path('uploads/' . $file->hashName()));  // Se verifica si l archivo se almaceno correctamente
    }
}
