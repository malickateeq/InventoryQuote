<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quotation;

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
        if(Auth::user()->role == 'vendor' || Auth::user()->role == 'admin')
        {
            return Auth::user()->role.' is not allowed to perform this action.';
        }

        if(session('origin') == "")
        {
            return redirect()->back();
        }

        $quotation = new Quotation;
        $quotation->user_id = Auth::user()->id;
        $quotation->quotation_id = mt_rand();
        $quotation->origin = session('origin');
        $quotation->destination = session('destination');
        $quotation->transportation_type = session('transportation_type');
        $quotation->type = session('type');
        $quotation->ready_to_load_date = session('ready_to_load_date');

        
        $quotation->value_of_goods = $request->value_of_goods;
        $quotation->isStockable = $request->isStockable ? $request->isStockable : 'No';
        $quotation->isDGR = $request->isDGR ? $request->isDGR : 'No';
        $quotation->calculate_by = $request->calculate_by;
        $quotation->remarks = $request->remarks;
        $quotation->isClearanceReq = $request->isClearanceReq ? $request->isClearanceReq : 'No';
        
        $quotation->total_weight = $request->total_weight;

        if(session('transportation_type') == 'sea' && session('type') == 'fcl')
        {
            $quotation->container_size = $request->container_size;
            $quotation->no_of_containers = $request->no_of_containers;
        }
        if($request->calculate_by == 'units')
        {
            $quotation->quantity = $request->quantity_units;
        }
        else
        {
            $quotation->quantity = $request->quantity;
        }
        $quotation->save();

        session()->forget('origin');
        session()->forget('destination');
        session()->forget('transportation_type');
        session()->forget('type');
        session()->forget('ready_to_load_date');
        session()->forget('intended_url');

        return redirect(route('user.quotations'));
    }
}
