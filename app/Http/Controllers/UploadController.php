<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Bid;
use App\Photo;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use File;

class UploadController extends Controller
{
    public $formats = [
      'thumb' => [360, 200],
      'large' => [940, 530]
    ];

    public function upload()
    {
        $input = Input::all();

        $photo = $input['file'];
        $bid_id = $input['id'];

        $random_string = $this->random_string(32);

        foreach ($this->formats as $format => $dimensions)
        {
            $filename = $random_string . '_' . $format . '.' . $photo->getClientOriginalExtension();

            Photo::create([
                'bid_id' => $bid_id,
                'format' => $format,
                'filename' => $filename
              ]);

            Storage::disk('public')->put($this->getStorageDirectory($bid_id) . '/' . $filename, Image::make($photo)->fit($dimensions[0], $dimensions[1])->stream()->__toString());
        }

        $filename = $random_string . '_original.' . $photo->getClientOriginalExtension();

        Photo::create([
            'bid_id' => $bid_id,
            'format' => 'original',
            'filename' => $filename
        ]);

        Storage::disk('public')->put($this->getStorageDirectory($bid_id) . '/' . $filename, Image::make($photo)->stream()->__toString());

        DB::table('bids')->increment('photo_count');
    }

    public function delete()
    {
        $bid_id = Input::get('id');
        $filename = Input::get('filename');

        foreach ($this->formats as $format => $dimensions)
        {
            $filename = preg_replace('/(.*_)(.*)(\..*)/', "$1$format$3", $filename);

            Storage::disk('public')->delete($this->getStorageDirectory($bid_id) . '/' . $filename);
            Photo::where('filename', $filename)->where('bid_id', $bid_id)->delete();
        }

        $filename = preg_replace('/(.*_)(.*)(\..*)/', "$1original$3", $filename);

        Storage::disk('public')->delete($this->getStorageDirectory($bid_id) . '/' . $filename);
        Photo::where('filename', $filename)->where('bid_id', $bid_id)->delete();

        DB::table('bids')->decrement('photo_count');
    }

    public function getServerPhotos($bid_id)
    {
        $res = [];

        $photos = Photo::where('bid_id', $bid_id)->where('format', 'thumb')->get();

        for ($i = 1; $i <= Bid::where('id', $bid_id)->first()->photo_count; $i++)
        {
            $photo = $photos[$i - 1];

            $filename = $photo->filename;

            $res[] = [
                'filename' => $filename,
                'size' => Storage::disk('public')->size($this->getStorageDirectory($bid_id) . '/' . $filename),
                'server' => env('APP_URL') . Storage::disk('public')->url($this->getStorageDirectory($bid_id) . '/' . $filename)
            ];
        }

        return response()->json([
            'photos' => $res
        ]);
    }

    public function getStorageDirectory($bid_id)
    {
        return ceil($bid_id / 250);
    }

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
}
