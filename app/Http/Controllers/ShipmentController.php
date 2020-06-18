<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quotation;
use Carbon\Carbon;
use DateTime;

class ShipmentController extends Controller
{
    public function __construct()
    {
        //Specify required role for this controller here in checkRole:xyz
        // $this->middleware(['auth', 'checkRole:user'])->only(['form_quote_step2']); 
    }
}
