<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\flat;
use Kyslik\ColumnSortable\Sortable;

class declareWater extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id','flat_id','kitchen_cold','kitchen_hot','bath_cold','bath_hot','declaredBy','created_at','formatedDate'];


    public function forFlat(){
        return $this->belongsTo(Flat::class,'flat_id','id');
    }
}
