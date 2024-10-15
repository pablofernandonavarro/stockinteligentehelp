<?php

namespace Database\Seeders;

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

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles([$role1, $role2]);


        Permission::create(['name' => 'admin.etiqueta.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.etiqueta.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.etiqueta.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.etiqueta.destroy'])->syncRoles([$role1, $role2]);



        Permission::create(['name' => 'admin.posts.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy'])->syncRoles([$role1, $role2]);
    }
}
