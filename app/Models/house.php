<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flat;
use App\Models\pricelist;
use Kyslik\ColumnSortable\Sortable;

class house extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id','address','house_nr','house_size','created_at',];

    public function houseFlat(){
        return $this->hasMany(Flat::class,'house_id','id' );

    }
    public function pricelists(){
        return $this->hasMany(pricelist::class,'house_id','id' );

    }
}
