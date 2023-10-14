<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FormularioTest extends TestCase
{
    use RefreshDatabase;  // Esto resetea la base de datos antes de cada prueba.

    /** @test */
    public function a_user_can_submit_a_formulario()
    {
        // Preparación
        Storage::fake('local');  // Fake the storage disk to prevent actual file uploads
        $file = UploadedFile::fake()->create('document.pdf', 200);  // Create a fake file

        $response = $this->post('/formulario/store', [
            'nombre' => 'John Doe',
            'nombre_archivo' => $file,
        ]);

 // Afirmaciones
 $response->assertRedirect(route('formulario.show'));  // Asegúrate de que hay una redirección correcta
 $this->assertDatabaseHas('formularios', [
     'nombre' => 'John Doe',
     'nombre_archivo' => $file->hashName(),  // Asegúrate de que el archivo se almacenó correctamente
 ]);
 $this->assertFileExists(public_path('uploads/' . $file->hashName()));  // Asegúrate de que el archivo se almacenó correctamente en el disco
    }
}
