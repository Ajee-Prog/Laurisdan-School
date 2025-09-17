<?php

namespace App\Http\Controllers\FrontHomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaurisdanPageController extends Controller
{
    public function index(){
        // return view('laurisdan.index');
        return view('laurisdan.welcomes');
    }
}
