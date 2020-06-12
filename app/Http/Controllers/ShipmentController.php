<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function get_quote_step1(Request $request)
    {
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
        dd($request->all());
    }
}
