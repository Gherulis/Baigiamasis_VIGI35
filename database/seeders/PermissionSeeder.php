<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permissions = [
        'user-view',
        'user-create',
        'user-edit',
        'user-show',
        'user-delete',
        'role-view',
        'role-create',
        'role-edit',
        'role-delete',
        'permission-view',
        'permission-create',
        'permission-edit',
        'permission-delete',
      ];
      foreach ($permissions as $permission){
        Permission::create(['name'=>$permission]);
      }
    }
}
