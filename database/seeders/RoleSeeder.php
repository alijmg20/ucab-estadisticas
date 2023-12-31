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
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'Admin']);
        $role_researcher = Role::create(['name' => 'Investigador']);

        // PERMISOS DE DASHBOARD
        Permission::create([
            'name' => 'admin.home',
            'description' => 'Ver dashboard'
        ])->syncRoles([$role_admin, $role_researcher]);

        // PERMISOS DE USUARIO

        Permission::create([
            'name' => 'admin.users.index',
            'description' => 'Ver lista de usuarios'
        ])->syncRoles([$role_admin,$role_researcher]);

        Permission::create([
            'name' => 'admin.users.create',
            'description' => 'Crear usuarios'
        ])->syncRoles([$role_admin]);

        Permission::create([
            'name' => 'admin.users.edit',
            'description' => 'Editar usuarios'
        ])->syncRoles([$role_admin]);

        Permission::create([
            'name' => 'admin.users.destroy',
            'description' => 'Eliminar usuarios'
        ])->syncRoles([$role_admin]);

        // PERMISOS DE LINEAS DE INVESTIGACION
        Permission::create([
            'name' => 'admin.lines.index',
            'description' => 'Ver lista de líneas de investigación'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.lines.create',
            'description' => 'Crear línea de investigacion'
        ])->syncRoles([$role_admin]);
        Permission::create([
            'name' => 'admin.lines.edit',
            'description' => 'Editar línea de investigacion'
        ])->syncRoles([$role_admin]);
        Permission::create([
            'name' => 'admin.lines.destroy',
            'description' => 'Eliminar línea de investigacion'
        ])->syncRoles([$role_admin]);

        // PERMISOS DE PROYECTOS
        Permission::create([
            'name' => 'admin.projects.index',
            'description' => 'Ver lista de proyectos'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.projects.create',
            'description' => 'Crear proyectos'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.projects.edit',
            'description' => 'Editar proyectos'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.projects.destroy',
            'description' => 'Eliminar proyectos'
        ])->syncRoles([$role_admin, $role_researcher]);

        // PERMISOS DE ROLES
        Permission::create([
            'name' => 'admin.roles.index',
            'description' => 'Ver lista de roles'
        ])->syncRoles([$role_admin]);
        Permission::create([
            'name' => 'admin.roles.create',
            'description' => 'Crear roles'
        ])->syncRoles([$role_admin]);
        Permission::create([
            'name' => 'admin.roles.edit',
            'description' => 'Editar roles'
        ])->syncRoles([$role_admin]);
        Permission::create([
            'name' => 'admin.roles.destroy',
            'description' => 'Eliminar roles'
        ])->syncRoles([$role_admin]);

        // PERMISOS DE EMAILS
        Permission::create([
            'name' => 'admin.emails.index',
            'description' => 'Ver lista de emails'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.emails.create',
            'description' => 'Crear emails'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.emails.edit',
            'description' => 'Editar emails'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.emails.destroy',
            'description' => 'Eliminar emails'
        ])->syncRoles([$role_admin, $role_researcher]);

        // PERMISOS DE IA
        Permission::create([
            'name' => 'admin.openai.index',
            'description' => 'Utilizar IA'
        ])->syncRoles([$role_admin, $role_researcher]);

        // PERMISOS DE testimonials
        Permission::create([
            'name' => 'admin.testimonials.index',
            'description' => 'Ver lista de Experiencias'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.testimonials.create',
            'description' => 'Crear Experiencias'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.testimonials.edit',
            'description' => 'Editar Experiencias'
        ])->syncRoles([$role_admin, $role_researcher]);
        Permission::create([
            'name' => 'admin.testimonials.destroy',
            'description' => 'Eliminar Experiencias'
        ])->syncRoles([$role_admin, $role_researcher]);

        // PERMISOS DE MODULES
        Permission::create([
            'name' => 'admin.modules.index',
            'description' => 'GESTIONAR MODULOS'
        ])->syncRoles([$role_admin]);
    }
}
