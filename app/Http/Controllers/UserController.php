<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Quotation;
use Carbon\Carbon;

class UserController extends Controller
{
    //
    public function __construct()
    {
        //Specify required role for this controller here in checkRole:xyz
        $this->middleware(['auth', 'checkRole:user']); 
    }
    public function index()
    {
        $data['page_title'] = 'Dashboard | LogistiQuote';
        $data['page_name'] = 'user_dashboard';
        return view('panels.user.dashboard', $data);
    }
    public function profile()
    {
        $data['page_title'] = 'User Profile | LogistiQuote';
        $data['page_name'] = 'user_profile';
        return view('panels.user.profile', $data);
    }
    public function quotations()
    {
        $data['page_title'] = 'User Quotations | LogistiQuote';
        $data['page_name'] = 'user_quotations';
        $data['quotations'] = Quotation::where('user_id', Auth::user()->id)->get();

        return view('panels.user.quotations', $data);
    }
    public function add_quotation()
    {
        $data['page_title'] = 'Request a Quotation | LogistiQuote';
        $data['page_name'] = 'add_quotation';

        return view('panels.user.add_quotation', $data);
    }
    public function sotre_quotation(Request $request)
    {
        // dd( Carbon::parse($request->date) );
        
        $validatedData = $request->validate([
            'origin_city' => ['required', 'string', 'min:3', 'max:255'],
            'origin_state' => ['required', 'string', 'min:3', 'max:255'],
            'origin_country' => ['required', 'string', 'min:3', 'max:255'],
            'origin_zip' => ['required', 'numeric', 'min:3', 'max:9999999'],
            'destination_city' => ['required', 'string', 'min:3', 'max:255'],
            'destination_state' => ['required', 'string', 'min:3', 'max:255'],
            'destination_country' => ['required', 'string', 'min:3', 'max:255'],
            'destination_zip' => ['required', 'numeric', 'min:3', 'max:9999999'],
            'transportation_type' => ['required', 'string', 'min:3', 'max:255'],
            'type' => ['required', 'string', 'min:2', 'max:255'],
            'date' => ['required', 'string', 'min:3', 'max:255'],
            'value_of_goods' => ['required', 'numeric', 'min:3', 'max:255'],
            'calculate_by' => ['required', 'string', 'min:3', 'max:255'],
            'remarks' => ['required', 'string', 'min:3', 'max:255'],
            'total_weight' => ['required', 'numeric', 'min:3', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $quotation = new Quotation;
        $quotation->user_id = Auth::user()->id;
        $quotation->quotation_id = mt_rand();
        $quotation->origin = $request->origin_city.', '.$request->origin_state.', '.$request->origin_country.'. '.$request->origin_zip;
        $quotation->destination = $request->destination_city.', '.$request->destination_state.', '.$request->destination_country.'. '.$request->destination_zip;
        $quotation->transportation_type = $request->transportation_type;
        $quotation->type = $request->type;
        $quotation->ready_to_load_date = Carbon::parse($request->date);
        
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

        return redirect(route('user.quotations'));
    }
}
