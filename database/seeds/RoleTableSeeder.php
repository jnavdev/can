<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
            'name' => 'Super Administrador',
            'description' => 'Toda las opciones, crear y bajar  usuarios,  modificar, asignar, etc'
        ]);

        App\Role::create([
            'name' => 'Administrador',
            'description' => 'Crear nuevos negocios, modificar (cambiar estados) y asignar tareas'
        ]);

        App\Role::create([
            'name' => 'Ejecutivo',
            'description' => 'Crear nuevo negocios (solo puede cambiar estados si el creo el nuevo negocio). Participa en agregar información y asignar tareas'
        ]);

        App\Role::create([
            'name' => 'Cooperador',
            'description' => 'Solo puede participar agregando comentarios en los negocios abiertos'
        ]);

        App\Role::create([
            'name' => 'Consultor',
            'description' => 'Solo puede ver lo que tenga permiso'
        ]);
    }
}
