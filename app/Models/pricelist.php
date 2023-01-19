<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pricelist extends Model
{
    use HasFactory;

    public function belongsHouse(){
        return $this->belongsTo(House::class,'house_id','id');
    }
}
