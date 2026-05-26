<?php
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
// Validar que un proyecto sea del usuario autenticado

it('bloquear el acceso a proyectos ajenos', function () {
    $OtroUsuario=User::factory()->create();
    $proyectoAjeno=Project::factory()->create([
        'user_id'=>$OtroUsuario->id
    ]); 

    $UsuarioAutenticado=User::factory()->create();

    actingAs($UsuarioAutenticado)->get("/projects/{$proyectoAjeno->id}")
        ->assertStatus(403);
    

});