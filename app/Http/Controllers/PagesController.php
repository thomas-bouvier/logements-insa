<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bid;

class PagesController extends Controller
{
    public function home()
    {
        $bids = Bid::latest()->limit(2)->get();

        return view('pages.home', compact('bids'));
    }
}
