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
        'post-view',
        'post-create',
        'post-store',
        'post-show',
        'post-edit',
        'post-delete',
        'contacts-view',
        'contacts-create',
        'contacts-edit',
        'contacts-show',
        'contacts-store',
        'contacts-delete',
        'declare-view',
        'declare-indexByMonth',
        'declare-edit',
        'declare-show',
        'declare-create',
        'declare-store',
        'declare-delete',
        'declare-indexFlat',
        'flat-view',
        'flat-show',
        'flat-edit',
        'flat-create',
        'flat-store',
        'flat-delete',
        'house-view',
        'house-show',
        'house-showUserHouse',
        'house-edit',
        'house-create',
        'house-store',
        'house-delete',
        'pricelist-view',
        'pricelist-create',
        'pricelist-store',
        'pricelist-show',
        'pricelist-showPrices',
        'pricelist-edit',
        'pricelist-lastbill',
        'pricelist-delete',
        'invoices-view',
        'invoices-indexFlat',
        'invoices-create',
        'invoices-store',
        'bills-index',
        'bills-indexLast',
        'nkf-views',
        'nkf-create',
        'nkf-edit',
        'nkf-view',
        'nkf-show',
        'nkf-delete',
        'pirmininkas-view',

      ];
      foreach ($permissions as $permission){
        Permission::create(['name'=>$permission]);
      }
    }
}
