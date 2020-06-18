<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quotation;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function __construct()
    {
        //Specify required role for this controller here in checkRole:xyz
        // $this->middleware(['auth', 'checkRole:user']); 
        $this->middleware(['auth']); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['quotations'] = Quotation::where('user_id', Auth::user()->id)->get();
        $data['page_name'] = 'quotations';
        $data['page_title'] = 'View quotations | LogistiQuote';
        return view('panels.quotation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_name'] = 'create_quotation';
        $data['page_title'] = 'Create quotation | LogistiQuote';
        return view('panels.quotation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'incoterms' => ['required', 'string', 'min:3', 'max:255'],
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
            'ready_to_load_date' => ['required', 'string', 'min:3', 'max:255'],
            'value_of_goods' => ['required', 'numeric', 'min:3', 'max:255'],
            'calculate_by' => ['required', 'string', 'min:3', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $quotation = new Quotation;
        $quotation->user_id = Auth::user()->id;
        $quotation->quotation_id = mt_rand();
        $quotation->origin = $request->origin_city.', '.$request->origin_state.', '.$request->origin_country.'. '.$request->origin_zip;
        $quotation->destination = $request->destination_city.', '.$request->destination_state.', '.$request->destination_country.'. '.$request->destination_zip;
        $quotation->origin_zip = $request->origin_zip;
        $quotation->destination_zip = $request->destination_zip;
        $quotation->transportation_type = $request->transportation_type;
        $quotation->type = $request->type;
        $ready_to_load_date = Carbon::createFromFormat('d-m-Y', $request->ready_to_load_date );
        $quotation->ready_to_load_date = $ready_to_load_date->addMinutes(1);
        $quotation->incoterms = $request->incoterms;
        if($request->incoterms == 'EXW')
        {
            $quotation->pickup_address = $request->pickup_address;
            $quotation->final_destination_address = $request->final_destination_address;
        }
        
        $quotation->value_of_goods = $request->value_of_goods;
        $quotation->description_of_goods = $request->description_of_goods;
        $quotation->isStockable = $request->isStockable ? $request->isStockable : 'No';
        $quotation->isDGR = $request->isDGR ? $request->isDGR : 'No';
        $quotation->calculate_by = $request->calculate_by;
        $quotation->remarks = $request->remarks;
        $quotation->isClearanceReq = $request->isClearanceReq ? $request->isClearanceReq : 'No';
        

        if($request->transportation_type == 'sea' && $request->type == 'fcl')
        {
            $quotation->container_size = $request->container_size;
            $quotation->no_of_containers = $request->no_of_containers;
        }
        if($request->calculate_by == 'units')
        {
            $pallets = [];
            for($i=0; $i<count($request->quantity_units); $i++)
            {
                $total_weight = 
                ( (float)$request->l[$i] * (float)$request->w[$i] * (float)$request->h[$i] ) / 6000 * $request->quantity_units[$i];
                $pallets[] = [
                    'length' => $request->l[$i],
                    'width' => $request->w[$i],
                    'height' => $request->h[$i],
                    'total_weight' => $total_weight,
                    'quantity' => $request->quantity_units[$i],
                ];
            }
            $quotation->pallets = $pallets;
        }
        else
        {
            $quotation->quantity = $request->quantity;
            $quotation->total_weight = $request->total_weight;
        }
        $quotation->save();
        return redirect(route('quotation.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['quotation'] = Quotation::where('id', $id)->first();
        $data['page_name'] = 'view_quotation';
        $data['page_title'] = 'View quotation | LogistiQuote';
        return view('panels.quotation.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['quotation'] = Quotation::where('id', $id)->first();
        $data['page_name'] = 'edit_quotation';
        $data['page_title'] = 'Edit quotation | LogistiQuote';
        return view('panels.quotation.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'incoterms' => ['required', 'string', 'min:3', 'max:255'],
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
            'ready_to_load_date' => ['required', 'string', 'min:3', 'max:255'],
            'value_of_goods' => ['required', 'numeric', 'min:3', 'max:255'],
            'calculate_by' => ['required', 'string', 'min:3', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $quotation = Quotation::findorFail($id);
        $quotation->origin = $request->origin;
        $quotation->destination = $request->destination;
        $quotation->transportation_type = $request->transportation_type;
        $quotation->type = $request->type;
        $ready_to_load_date = Carbon::createFromFormat('d-m-Y', $request->ready_to_load_date );
        $quotation->ready_to_load_date = $ready_to_load_date->addMinutes(1);
        $quotation->incoterms = $request->incoterms;
        if($request->incoterms == 'EXW')
        {
            $quotation->pickup_address = $request->pickup_address;
            $quotation->final_destination_address = $request->final_destination_address;
        }

        $quotation->value_of_goods = $request->value_of_goods;
        $quotation->description_of_goods = $request->description_of_goods;
        $quotation->isStockable = $request->isStockable ? $request->isStockable : 'No';
        $quotation->isDGR = $request->isDGR ? $request->isDGR : 'No';
        $quotation->calculate_by = $request->calculate_by;
        $quotation->remarks = $request->remarks;
        $quotation->isClearanceReq = $request->isClearanceReq ? $request->isClearanceReq : 'No';
        
        $quotation->total_weight = $request->total_weight;

        if($request->transportation_type == 'sea' && $request->type == 'fcl')
        {
            $quotation->container_size = $request->container_size;
            $quotation->no_of_containers = $request->no_of_containers;
        }
        if($request->calculate_by == 'units')
        {
            $pallets = [];
            for($i=0; $i<count($request->quantity_units); $i++)
            {
                $total_weight = 
                ( (float)$request->l[$i] * (float)$request->w[$i] * (float)$request->h[$i] ) / 6000 * $request->quantity_units[$i];
                $pallets[] = [
                    'length' => $request->l[$i],
                    'width' => $request->w[$i],
                    'height' => $request->h[$i],
                    'total_weight' => $total_weight,
                    'quantity' => $request->quantity_units[$i],
                ];
            }
            $quotation->pallets = $pallets;
        }
        else
        {
            $quotation->total_weight = $request->total_weight;
            $quotation->quantity = $request->quantity;
        }
        $quotation->save();
        return redirect(route('quotation.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id); 
        $quotation->status = 'withdrawn';
        $quotation->save();
        return redirect(route('quotation.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view_all()
    {
        $data['quotations'] = Quotation::get();
        $data['page_name'] = 'quotations';
        $data['page_title'] = 'View quotations | LogistiQuote';
        return view('panels.quotation.search_quotations', $data);
    }
    public function search(Request $request)
    {
        // dd( $request->all() );

        $origin = $request->origin;
        $destination = $request->destination;
        $isStockable = $request->isStockable;
        $isDGR = $request->isDGR;
        $transportation_type = $request->transportation_type;
        $type = $request->type;
        $isClearanceReq = $request->isClearanceReq;

        $data['quotations'] = Quotation::
        where(function ($q) use($origin) {
            if ($origin) {
                $q->where('origin', 'LIKE', "%{$origin}%");
            }
        })
        ->orWhere(function ($q) use($destination) {
            if ($destination) {
                $q->where('destination', 'LIKE', "%{$destination}%");
            }
        })
        ->orWhere(function ($q) use($isStockable) {
            if ($isStockable) {
                $q->where('isStockable', 'LIKE', "%{$isStockable}%" );
            }
        })
        ->orWhere(function ($q) use($isDGR) {
            if ($isDGR) {
                $q->where('isDGR', 'LIKE', "%{$isDGR}%" );
            }
        })
        ->orWhere(function ($q) use($transportation_type) {
            if ($transportation_type) {
                $q->where('transportation_type', 'LIKE', "%{$transportation_type}%" );
            }
        })
        ->orWhere(function ($q) use($type) {
            if ($type) {
                $q->where('type', 'LIKE', "%{$type}%" );
            }
        })
        ->orWhere(function ($q) use($isClearanceReq) {
            if ($isClearanceReq) {
                $q->where('isClearanceReq', 'LIKE', "%{$isClearanceReq}%" );
            }
        })
        ->orderBy('created_at')->get();

        $data['page_name'] = 'quotations';
        $data['page_title'] = 'View quotations | LogistiQuote';
        return view('panels.quotation.search_quotations', $data);
    }
}
