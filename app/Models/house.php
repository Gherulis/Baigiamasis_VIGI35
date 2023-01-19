<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flat;
use App\Models\pricelist;

class house extends Model
{
    use HasFactory;
    public function houseFlat(){
        return $this->hasMany(Flat::class,'house_id','id' );

    }
    public function pricelists(){
        return $this->hasMany(pricelist::class,'house_id','id' );

    }
}
