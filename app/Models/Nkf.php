<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;

class Nkf extends Model
{
    use HasFactory,Sortable;
    public $sortable = ['id','amountPayed','description','house_id','type','created_at'];

}
