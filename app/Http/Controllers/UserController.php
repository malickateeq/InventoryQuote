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
}
