<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Homepage | LogistiQuote';
        $data['page_name'] = 'homepage';
        return view('frontend.index', $data);
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

}
