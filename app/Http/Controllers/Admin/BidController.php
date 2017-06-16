<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bid;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $pending_bids = Bid::pending()->get();
        $approved_bids = Bid::approved()->get();
        $postponed_bids = Bid::postponed()->get();

        return view('admin.bids.index', compact('pending_bids', 'approved_bids', 'postponed_bids'));
    }

    public function approve($id)
    {
        $bid = Bid::findOrFail($id);

        $bid->markApproved();

        return redirect(route('admin.bids.index'))->with('success', 'L\'annonce a été modérée avec succès et est maintenant en ligne.');
    }

    public function reject($id)
    {
        $bid = Bid::findOrFail($id);

        $bid->markRejected();

        return redirect(route('admin.bids.index'))->with('success', 'L\'annonce a été modérée avec succès et est maintenant supprimée.');
    }

    public function postpone($id)
    {
        $bid = Bid::findOrFail($id);

        $bid->markPostponed();

        return redirect(route('admin.bids.index'))->with('success', 'L\'annonce a été modérée avec succès et a bien été mise en attente.');
    }
}
