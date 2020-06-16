<?php
use App\Quotation;
use App\Proposal;
use Carbon\Carbon;


/**
 * Carbon helper
 *
 * @param $time
 * @param $tz
 *
 * @return Carbon\Carbon
 */
function is_offer_made($partner_id = null, $quotation_id = null)
{
    $proposal_available = Proposal::where('partner_id', $partner_id)
    ->where('quotation_id', $quotation_id)->count();
    return $proposal_available;
}

function is_proposal_expired($proposal_id = null)
{
    $proposal = Proposal::where('id', $proposal_id)->first();
    $now = Carbon::now();
    $start_date = Carbon::parse($proposal->created_at);
    $end_date = Carbon::parse($proposal->valid_till);

    $flag = true;
    if($now->between($start_date,$end_date)){
        $flag = false; // Not Expired
    } else {
        $flag = true; // Expired
    }
    return $flag;
}
function carbon_format($timestamp, $format)
{
    $carbon_date = Carbon::parse($timestamp);
    $formatted_date = $carbon_date->format($format);
    return $formatted_date;
}