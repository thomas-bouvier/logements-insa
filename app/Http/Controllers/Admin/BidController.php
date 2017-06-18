<?php

namespace App\Http\Controllers\Admin;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bid;
use App\User;

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

        // Sending a mail to author

        $email = User::where('id', $bid->user_id)->first()->email();

        Mail::send('emails.approve', ['bid' => $bid], function($message) use ($email)
        {
            $message->to($email);
        });

        return redirect(route('admin.bids.index'))->with('success', 'L\'annonce a été modérée avec succès et est maintenant en ligne.');
    }

    public function reject($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->markRejected();

        // Sending a mail to author

        $email = User::where('id', $bid->user_id)->first()->email();

        Mail::send('emails.reject', ['bid' => $bid], function($message) use ($email)
        {
            $message->to($email);
        });

        return redirect(route('admin.bids.index'))->with('success', 'L\'annonce a été modérée avec succès et est maintenant supprimée.');
    }

    public function postpone($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->markPostponed();

        // Sending a mail to author

        $email = User::where('id', $bid->user_id)->first()->email();

        Mail::send('emails.postpone', ['bid' => $bid], function($message) use ($email)
        {
            $message->to($email);
        });

        return redirect(route('admin.bids.index'))->with('success', 'L\'annonce a été modérée avec succès et a bien été mise en attente.');
    }
}
