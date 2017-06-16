<?php

namespace App\Http\Controllers;

use Session;
use App\Http\Requests\BidRequest;
use App\Bid;
use App\User;
use App\Photo;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('owner', ['except' => ['index', 'store', 'create', 'show']]);
    }

    public function getResource($id)
    {
        return Bid::findOrFail($id);
    }

    public function index()
    {
        $user_id = User::where('login', cas()->user())->first()->id;

        $bids = Bid::notDraft()->where('user_id', $user_id)->get();
        $bids->load('type');

        return view('bids.index', compact('bids'));
    }

    public function show($id)
    {
        $bid = Bid::findOrFail($id);

        if ($bid->isPending())
        {
            Session::flash('warning', 'Cette annonce n\'a pas encore été modérée et n\'est donc pas visible des autres utilisateurs.');
        }
        else if ($bid->isPostponed())
        {
            Session::flash('warning', 'Cette annonce a été mise en attente et n\'est donc pas visible des autres utilisateurs. Corrigez-là pour qu\'elle soit de nouveau modérée.');
        }

        return view('bids.show', compact('bid'));
    }

    public function create()
    {
        //$bid = new Bid();
        $bid = Bid::draft();

        //return view('bids.create', compact('bid'));
        return $this->edit($bid);
    }

    public function store(BidRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = User::where('login', cas()->user())->first()->id;

        Bid::create($data);

        return redirect(route('bids.index'))->with('success', "Votre annonce a bien été créée. Elle est maintenant en cours de modération, et sera bientôt en ligne.");
    }

    public function edit($bid)
    {
        return view('bids.edit', compact('bid'));
    }

    public function update($bid, BidRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = User::where('login', cas()->user())->first()->id;

        $bid->update($data);

        return redirect(route('bids.index'))->with('success', "Votre annonce a bien été mise à jour.");
    }

    public function destroy($bid)
    {
        $bid->delete();

        return redirect(route('bids.index'))->with('success', "Votre annonce a bien été supprimée.");
    }
}
