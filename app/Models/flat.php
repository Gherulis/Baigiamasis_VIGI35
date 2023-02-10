<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\House;
use App\Models\pricelist;
use App\Models\declareWater;
use Kyslik\ColumnSortable\Sortable;

class flat extends Model
{
    use HasFactory, Sortable;
    protected $fillable = [
        'flat_nr', 'flat_size', 'gyv_mok_suma', 'invitation', 'house_id'
    ];
    public $sortable = ['id','house_id','flat_nr','flat_size','gyv_mok_suma','created_at',];

public function flatUsers(){
    return $this->hasMany(User::class,'flat_id','id' );

}
public function belongsHouse(){
    return $this->belongsTo(House::class,'house_id','id');
}
public function flatDeclarations(){
    return $this->hasMany(declareWater::class,'flat_id','id' );

}


}
