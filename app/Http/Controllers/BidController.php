<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;

class BidController extends Controller
{
  public function index()
  {
    $bids = Bid::all();

    return view('bids.index', compact('bids'));
  }

  public function create()
  {
    $bid = new Bid();

    return view('bids.create', compact('bid'));
  }

  public function store(Request $request)
  {
    Bid::create($request->only('name', 'slug'));

    return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été créée.");
  }

  public function edit($id)
  {
    $bid = Bid::findOrFail($id);

    return view('bids.edit', compact('bid'));
  }

  public function update($id, Request $request)
  {
    $bid = Bid::findOrFail($id);
    $bid->update($request->only('name', 'slug'));

    return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été mise à jour.");
  }

  public function destroy($id)
  {
    $bid = Bid::findOrFail($id);
    $bid->delete();

    return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été supprimée.");
  }
}
