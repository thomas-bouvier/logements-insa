<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Bid;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('owner', ['except' => ['index', 'store', 'create']]);
    }

    public function getResource($id)
    {
        return Bid::findOrFail($id);
    }

    public function index()
    {
        $bids = Bid::where('user_id', cas()->user())->get();
        $bids->load('type');

        return view('bids.index', compact('bids'));
    }

    public function create()
    {
        $bid = new Bid();

        return view('bids.create', compact('bid'));
    }

    public function store(BidRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = cas()->user();

        Bid::create($data);

        return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été créée.");
    }

    public function edit($bid)
    {
        return view('bids.edit', compact('bid'));
    }

    public function update($bid, BidRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = cas()->user();

        $bid->update($data);

        return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été mise à jour.");
    }

    public function destroy($bid)
    {
        $bid->delete();

        return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été supprimée.");
    }
}
