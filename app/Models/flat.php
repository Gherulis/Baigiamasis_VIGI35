<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\House;
use App\Models\pricelist;
use App\Models\declareWater;

class flat extends Model
{
    use HasFactory;

public function flatUsers(){
    return $this->hasMany(User::class,'flat_id','id' );

}
public function belongsHouse(){
    return $this->belongsTo(House::class,'house_id','id');
}
public function flatDeclarations(){
    return $this->hasMany(declareWater::class,'id','flat_id' );

}


}
