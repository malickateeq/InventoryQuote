<?php

namespace App\Http\Controllers;

use App\Proposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Quotation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Homepage | LogistiQuote';
        $data['page_name'] = 'homepage';
        return view('frontend.index', $data);
    }
    public function get_quote_step1(Request $request)
    {
        $data = [
            'type' => $request->type,
            'transportation_type' => $request->transportation_type,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'ready_to_load_date' => $request->date,
        ];
        $isDelete = Storage::disk('public')->delete('store_pending_form.json');
        Storage::disk('public')->put('store_pending_form.json', json_encode($data));

        return redirect(route('get_quote_step2'));
    }
    public function get_quote_step2()
    {
        $fileContents = Storage::disk('public')->get('store_pending_form.json');
        $fileContents = json_decode($fileContents);
        
        if($fileContents->ready_to_load_date == null)
        {
            return redirect(route('index'));
        }
        $data['page_title'] = 'Request a quote | LogistiQuote';
        $data['page_name'] = 'get_quote_step2';

        if($fileContents->type == 'lcl' || $fileContents->transportation_type == 'air')
        {
            return view('frontend.get_quote_lcl', $data);
        }
        else if($fileContents->transportation_type == 'sea' && $fileContents->type == 'fcl')
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
        $fileContents = Storage::disk('public')->get('store_pending_form.json');
        $fileContents = json_decode($fileContents, true);
        $merge = array_merge($fileContents, $request->all());
        
        $isDelete = Storage::disk('public')->delete('store_pending_form.json');
        Storage::disk('public')->put('store_pending_form.json', json_encode($merge));
        
        if($fileContents['origin'] == "")
        {
            return redirect(route('index'));
        }

        if(Auth::check())
        {
            if(Auth::user()->role != 'user')
            {
                $isDelete = Storage::disk('public')->delete('store_pending_form.json');
                return "You are no allowed to perform this action. Only user can add quotation.";
            }
            else
            {
                return redirect()->route('store_pending_form');
            }
        }
        else
        {
            return redirect(route('login'));
        }
    }

    public function mail_view_proposal($token)
    {
        $proposal = Proposal::where('url', $token)->first();
        return redirect(route('proposal.show', $proposal->id));
    }
}
