<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->addRolesAndPermissions();
    }

    private function addRolesAndPermissions()
    {
        $userModulePermissions = collect([
            // 'create student',
            // 'show student', 
            // 'fetch student',
            // 'update student', 
            // 'delete student',
            // 'create staff',
            // 'show staff', 
            // 'fetch staff',
            // 'update staff', 
            // 'delete staff',
            

            ])->map(function ($name) {
            return Permission::create(['guard_name' => 'api','name' => $name]);
        });
    }
}
