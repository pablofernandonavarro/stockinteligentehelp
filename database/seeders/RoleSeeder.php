<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'publisher']);
       
        Permission::create(['name' => 'admin.home','description'=>'Ver Panel Administratico'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index','description'=>'Ver Listado Usuarios'])->syncRoles([$role1]);
       
        Permission::create(['name' => 'admin.users.edit','description'=>'Asignar un rol a Usuario'])->syncRoles([$role1]);



        Permission::create(['name' => 'admin.categories.index','description'=>'Ver Categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.create','description'=>'Crear Categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit','description'=>'Editar Categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy','description'=>'Eliminar Categorías'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.etiqueta.index','description'=>'Ver listado Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.etiqueta.create','description'=>'Crear Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.etiqueta.edit','description'=>'Editar Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.etiqueta.destroy','description'=>'Eliminar Etiquetas'])->syncRoles([$role1]);



        Permission::create(['name' => 'admin.posts.index','description'=>'Ver listado de Publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create','description'=>'Craer Publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit','description'=>'Editar Publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy','description'=>'Eliminar Publicaciones'])->syncRoles([$role1, $role2]);
    }
}
