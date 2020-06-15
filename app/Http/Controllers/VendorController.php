<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    //
    public function __construct()
    {
        //Specify required role for this controller here in checkRole:xyz
        $this->middleware(['auth', 'checkRole:vendor']); 
    }
    public function index()
    {
        $data['page_title'] = 'Dashboard | LogistiQuote';
        $data['page_name'] = 'ven_dashboard';
        return view('panels.ven.dashboard', $data);
    }
}
