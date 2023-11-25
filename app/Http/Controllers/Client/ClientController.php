<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Models\User;

class ClientController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request){
    	
    	return view('page.filemanager');
    }
}