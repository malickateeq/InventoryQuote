<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    //
    protected $fillable = [
        'user_id', 'origin', 'destination', 'transportation_type', 'type', 
        'ready_to_load_date', 'value_of_goods', 'isStockable', 'calculate_by', 
        'gross_vol', 'cargo_weight', 'remarks', 'isClearanceReq', 'quantity', 
        'l', 'w', 'h'
        ];
}
