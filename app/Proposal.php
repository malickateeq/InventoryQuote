<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //
    protected $fillable = [
        'quotationn_id', 'partner_id', 'local_charges', 'freight_charges', 'destination_local_charges', 
        'customs_clearance_charges', 'remarks', 'valid_till', 'total'
        ];
    protected $dates = [
        'valid_till',
    ];
    public function quotation()
    {
        return $this->belongsTo('App\Quotation','quotation_id');
    }
}
