<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Freight;

class ShipmentController extends Controller
{
    public function __construct()
    {
        //Specify required role for this controller here in checkRole:xyz
        // $this->middleware(['auth', 'checkRole:user'])->only(['form_quote_step2']); 
    }
    public function get_quote_step1(Request $request)
    {
        // Store step1 in session
        session([
            'type' => $request->type,
            'transportation_type' => $request->transportation_type,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'date' => $request->date,
        ]);
        session()->save();

        $redirect_to = url('get_quote_step2');
        if(Auth::check())
        {
            return redirect($redirect_to);
        }
        else
        {
            session([
                'intended_url' => $redirect_to
            ]);
            session()->save();
            return redirect()->route('login');
        }

    }
    public function form_quote_step2(Request $request)
    {
        dd( $request->all() );
        if(session('origin') == "")
        {
            return redirect()->back();
        }

        $freight = new Freight;
        $freight->user_id = Auth::user()->id;
        $freight->origin = session('origin');
        $freight->destination = session('destination');
        $freight->transportation_type = session('transportation_type');
        $freight->type = session('type');
        $freight->ready_to_load_date = session('ready_to_load_date');

        
        $freight->value_of_goods = $request->value_of_goods;
        $freight->isStockable = $request->isStockable ? $request->isStockable : 'No';
        $freight->calculate_by = $request->calculate_by;
        $freight->remarks = $request->remarks;
        $freight->isClearanceReq = $request->isClearanceReq ? $request->isClearanceReq : 'No';

        if($request->calculate_by == 'units')
        {
            $freight->quantity = $request->quantity;
            $freight->l = $request->l;
            $freight->w = $request->w;
            $freight->h = $request->h;
        }
        else
        {
            $freight->gross_vol = $request->gross_vol;
            $freight->cargo_weight = $request->cargo_weight;
        }
        $freight->save();
    }
}
