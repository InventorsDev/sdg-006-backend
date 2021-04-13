<?php

use Illuminate\Database\Seeder;
use \App\Models\Role;
use \App\Models\Permission;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $userModuleRoles = collect(['Primary Admin','medhouse_patients','medhouse_specialist'])->map(function ($name) {
            return Role::create(['guard_name' => 'api','name' => $name]);
        });

        $role = Role::where('name', 'Primary Admin')->first();
        
        // Attach all permissions to role
        $role->syncPermissions(Permission::all());
    }
}
