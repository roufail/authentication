<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $permissions = [
            'create-topic',
            'edit-topic',
            'delete-topic',
         ];
    
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         } 
    }

}
