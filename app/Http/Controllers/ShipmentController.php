<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function get_quote_step1(Request $request)
    {
        // dd( $request->all() );
        // Delete any previous session
        session()->forget('type');

        // Store step1 in session
        session([
            'type' => $request->type,
            'transportation_type' => $request->transportation_type,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'date' => $request->date,
        ]);
        session()->save();

        return redirect(route('get_quote_step2'));
        if($request->type == 'lcl' || $request->transportation_type == 'air')
        {
            return redirect(route('get_quote_step2'));
        }
        else if($request->transportation_type == 'sea' && $request->type == 'fcl')
        {
            return 'page 3 coming soon';
            return redirect(route('get_quote_step2'));
        }
    }
    public function form_quote_step2(Request $request)
    {
        // dd( Auth::check() );
        // Store all values in session
        session([
            'type' => $request->type,
            'value_of_goods' => $request->value_of_goods,
            'isStockable' => $request->isStockable,
            'calculate_by' => $request->calculate_by,
            'gross_vol' => $request->gross_vol,
            'cargo_weight' => $request->cargo_weight,
            'remarks' => $request->remarks,
            'isClearanceReq' => $request->isClearanceReq,
        ]);
        session()->save();
        if($request->calculate_by == 'units')
        {
            session([
                'quantity' => $request->quantity,
                'l' => $request->l,
                'w' => $request->w,
                'h' => $request->h
            ]);
            session()->save();
        }
        return redirect()->route('login');
    }
}
