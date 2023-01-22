<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class pricelist extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id','created_at','saltas_vanduo','karstas_vanduo','sildymas','silumos_mazg_prieziura','gyvatukas','salto_vandens_abon','elektra_bendra','ukio_islaid','nkf'];

    public function belongsHouse(){
        return $this->belongsTo(House::class,'house_id','id');
    }
}
