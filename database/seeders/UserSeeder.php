<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'S-admin',
            'email' => 'admin@namas.lt',
            'password' => Hash::make('123456'),

        ]);
        $user->save();

        $role = Role::find('1');
        $permission = Permission::pluck('id','id')->all();
        $role->syncPermissions($permission);
        $user->assignRole($role->id);


        $user = User::create([
            'name' => 'Rima',
            'email' => 'pirmininkas@namas.lt',
            'password' => Hash::make('123456'),

        ]);
        $user->save();
        $role = Role::find('3');
        $user->assignRole($role->id);

        $user = User::create([
            'name' => 'Agnė',
            'email' => 'pirmininkasAgnė@namas.lt',
            'password' => Hash::make('123456'),

        ]);
        $user->save();
        $role = Role::find('3');
        $user->assignRole($role->id);


        $user = User::create([
            'name' => 'Rolas',
            'email' => 'gyventojas@namas.lt',
            'password' => Hash::make('123456'),

        ]);
        $user->save();
        $role = Role::find('4');
        $permission = Permission::pluck('id','id')->all();
        $role->syncPermissions($permission);
        $user->assignRole($role->id);



    }

}
