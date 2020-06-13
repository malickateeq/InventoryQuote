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
        return "vendor";
    }
}
