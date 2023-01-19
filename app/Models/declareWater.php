<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\flat;

class declareWater extends Model
{
    use HasFactory;


    public function forFlat(){
        return $this->belongsTo(Flat::class,'flat_id','id');
    }
}
