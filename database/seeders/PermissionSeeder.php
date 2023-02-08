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
        'posts-index',
        'post-create',
        'post-store',
        'post-show',
        'post-edit',
        'post-delete',
        'contacts-index',
        'contacts-create',
        'contact-edit',
        'contact-show',
        'contacts-store',
        'contact-delete',
        'declare-index',
        'declare-indexByMonth',
        'declare-edit',
        'declare-show',
        'declare-create',
        'declare-store',
        'declare-delete',
        'declare-indexFlat',
        'flat-index',
        'flat-show',
        'flat-edit',
        'flat-create',
        'flat-store',
        'flat-delete',
        'house-index',
        'house-show',
        'house-edit',
        'house-create',
        'house-store',
        'house-delete',
        'pricelist-index',
        'pricelist-create',
        'pricelist-store',
        'pricelist-show',
        'pricelist-showPrices',
        'pricelist-edit',
        'pricelist-lastbill',
        'pricelist-delete',
        'invoices-index',
        'invoices-indexFlat',
        'invoices-create',
        'invoices-store',
        'bills-index',
        'bills-indexLast',
        'nkf-index',
        'nkf-create',
        'nkf-edit',
        'nkf-view',
        'nkf-show',

      ];
      foreach ($permissions as $permission){
        Permission::create(['name'=>$permission]);
      }
    }
}
