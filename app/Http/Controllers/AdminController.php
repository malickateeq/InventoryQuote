<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        //Specify required role for this controller here in checkRole:xyz
        $this->middleware(['auth', 'checkRole:admin']); 
    }
    public function index()
    {
        $data['page_title'] = 'Dashboard | LogistiQuote';
        $data['page_name'] = 'admin_dashboard';
        return view('panels.admin.dashboard', $data);
    }
}
