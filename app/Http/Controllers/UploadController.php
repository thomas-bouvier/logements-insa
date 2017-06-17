<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

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

    public function upload(Request $request)
    {
        $input = Input::all();

        /*
        $validator = Validator::make($input, Photo::$rules, Photo::$messages);

        if ($validator->fails())
        {
            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);
        }
        */

        $photo = $input['file'];

        // Storing the temp folder name in the Session

        $temp_folder_name = $request->session()->get('temp_folder_name', $this->random_string(32));

        if (!$request->session()->has('temp_folder_name'))
        {
            $request->session()->put('temp_folder_name', $temp_folder_name);
        }

        // Generating a filename

        $filename = $this->random_string(32) . '.' . $photo->getClientOriginalExtension();

        foreach ($this->formats as $format => $dimensions)
        {
            Storage::disk('public')->put('temp/' . $temp_folder_name . '/' . $format . '/' . $filename, Image::make($photo)->fit($dimensions[0], $dimensions[1])->stream()->__toString());
        }

        Storage::disk('public')->put('temp/' . $temp_folder_name . '/original/' . $filename, Image::make($photo)->stream()->__toString());
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
                'size' => Storage::disk('public')->size($bid_id . '/original/' . $filename),
                'server' => url(Storage::disk('public')->url($bid_id . '/thumb/' . $filename))
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
