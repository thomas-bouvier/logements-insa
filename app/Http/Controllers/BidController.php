<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Bid;
use App\User;

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

        $bids = Bid::where('user_id', $user_id)->get();
        $bids->load('type');

        return view('bids.index', compact('bids'));
    }

    public function show($id)
    {
        $bid = Bid::findOrFail($id);

        return view('bids.show', compact('bid'));
    }

    public function create()
    {
        $bid = new Bid();

        return view('bids.create', compact('bid'));
    }

    public function store(BidRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = User::where('login', cas()->user())->first()->id;
        $data['photo_count'] = count($request->files->get('photos'));

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
        $data['user_id'] = User::where('login', cas()->user())->first()->id;

        $bid->update($data);

        return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été mise à jour.");
    }

    public function destroy($bid)
    {
        $bid->delete();

        return redirect(action('BidController@index'))->with('success', "Votre annonce a bien été supprimée.");
    }

    public function uploadPhotos($photos)
    {
        $formats = [
          'thumb' => [360, 200],
          'large' => [940, 530]
        ];

        $index = 1;

        foreach($photos as $photo)
        {
            self::saved(function($instance) use ($photo, $index)
            {
                foreach ($instance->formats as $format => $dimensions)
                {
                    $filename = $instance->id . '_' . $index . '_' . $format . '.' . $photo->getClientOriginalExtension();

                    Photo::create([
                        'bid_id' => $this->id,
                        'filename' => $filename
                      ]);

                    Storage::disk('public')->put($this->getStorageDirectory() . '/' . $filename, Image::make($photo)->fit($dimensions[0], $dimensions[1])->stream()->__toString());
                }

                $filename = $instance->id . '_' . $index . '_original.' . $photo->getClientOriginalExtension();

                Photo::create([
                    'bid_id' => $this->id,
                    'filename' => $filename
                  ]);

                Storage::disk('public')->put($this->getStorageDirectory() . '/' . $filename, Image::make($photo)->stream()->__toString());
            });

            $index++;
        }
    }
}
