<?php

namespace App\Http\Controllers;

use App\Proposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Quotation;
use Carbon\Carbon;

class SiteController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Homepage | LogistiQuote';
        $data['page_name'] = 'homepage';
        return view('frontend.index', $data);
    }
    public function get_quote_step1(Request $request)
    {
        // Store step1 in session
        session([
            'type' => $request->type,
            'transportation_type' => $request->transportation_type,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'ready_to_load_date' => $request->date,
        ]);
        session()->save();
        return redirect(route('get_quote_step2'));
    }
    public function get_quote_step2()
    {
        $data['page_title'] = 'Request a quote | LogistiQuote';
        $data['page_name'] = 'get_quote_step2';
        if(session('type') == 'lcl' || session('transportation_type') == 'air')
        {
            return view('frontend.get_quote_lcl', $data);
        }
        else if(session('transportation_type') == 'sea' && session('type') == 'fcl')
        {
            return view('frontend.get_quote_fcl', $data);
        }
        else
        {
            return "An error occurred!";
        }
    }
    public function form_quote_step2(Request $request)
    {
        // Store all except
        session()->put('form_data', $request->all());
        session()->save();

        if(session('origin') == "")
        {
            return redirect(route('index'));
        }

        if(Auth::check())
        {
            if(Auth::user()->role != 'user')
            {
                return "You are no allowed to perform this action. Only user can add quotation.";
            }
            else
            {
                return redirect()->route('store_pending_form');
            }
        }
        else
        {
            session([
                'pending_task' => 'store_pending_form'
            ]);
            session()->save();
            return redirect()->route('login');
        }
    }

    public function store_pending_form()
    {
        if(!Auth::check())
        {
            session([
                'pending_task' => 'store_pending_form'
            ]);
            session()->save();
            return redirect()->route('login');
        }
        $quotation = new Quotation;
        $quotation->user_id = Auth::user()->id;
        $quotation->quotation_id = mt_rand();
        $quotation->origin = session('origin');
        $quotation->destination = session('destination');
        $quotation->transportation_type = session('transportation_type');
        $quotation->type = session('type');
        $quotation->incoterms = session('form_data.incoterms');

        if(session('incoterms') == 'EXW')
        {
            $quotation->pickup_address = session('form_data.pickup_address');
            $quotation->final_destination_address = session('form_data.final_destination_address');
        }

        $ready_to_load_date = Carbon::createFromFormat('d-m-Y', session('ready_to_load_date') );
        $quotation->ready_to_load_date = $ready_to_load_date->addMinutes(1);

        $quotation->value_of_goods = session('form_data.value_of_goods');
        $quotation->description_of_goods = session('form_data.description_of_goods');
        $quotation->isStockable = session('form_data.isStockable') ? session('form_data.isStockable') : 'No';
        $quotation->isDGR = session('form_data.isDGR') ? session('form_data.isDGR') : 'No';
        $quotation->calculate_by = session('form_data.calculate_by');
        $quotation->remarks = session('form_data.remarks');
        $quotation->isClearanceReq = session('form_data.isClearanceReq') ? session('form_data.isClearanceReq') : 'No';
        

        if(session('form_data.transportation_type') == 'sea' && session('form_data.type') == 'fcl')
        {
            $quotation->container_size = session('form_data.container_size');
            $quotation->no_of_containers = session('form_data.no_of_containers');
        }
        if(session('form_data.calculate_by') == 'units')
        {
            $pallets = [];
            for($i=0; $i<count(session('form_data.quantity_units')); $i++)
            {
                $total_weight = 
                ( (float)session('form_data.l')[$i] * (float)session('form_data.w')[$i] * (float)session('form_data.h')[$i] ) / 6000 * session('form_data.quantity_units')[$i];
                $pallets[] = [
                    'length' => session('form_data.l')[$i],
                    'width' => session('form_data.w')[$i],
                    'height' => session('form_data.h')[$i],
                    'total_weight' => $total_weight,
                    'quantity' => session('form_data.quantity_units')[$i],
                ];
            }
            $quotation->pallets = $pallets;
        }
        else
        {
            $quotation->quantity = session('form_data.quantity');
            $quotation->total_weight = session('form_data.total_weight');
        }
        $quotation->save();

        session()->forget('origin');
        session()->forget('destination');
        session()->forget('transportation_type');
        session()->forget('type');
        session()->forget('ready_to_load_date');
        session()->forget('intended_url');
        session()->forget('form_data');

        return redirect(route('quotation.index'));
    }

    public function mail_view_proposal($token)
    {
        $proposal = Proposal::where('url', $token)->first();
        return redirect(route('proposal.show', $proposal->id));
    }
}
