<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Site\Resort;
use App\Models\Site\ResortImages;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResortController extends Controller
{
    function index(){
        $resorts = Resort::all();
        return view('site.home', ['resorts'=>$resorts]);
    }

    
}
