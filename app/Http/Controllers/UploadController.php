<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Bid;
use App\Photo;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class UploadController extends Controller
{
    public function upload()
    {
        $input = Input::all();

        $photo = $input['file'];
        $bid_id = $input['id'];

        $formats = [
          'thumb' => [360, 200],
          'large' => [940, 530]
        ];

        foreach ($formats as $format => $dimensions)
        {
            $filename = $this->random_string(32) . '.' . $photo->getClientOriginalExtension();

            Photo::create([
                'bid_id' => $bid_id,
                'format' => $format,
                'filename' => $filename
              ]);

            Storage::disk('public')->put($this->getStorageDirectory($bid_id) . '/' . $filename, Image::make($photo)->fit($dimensions[0], $dimensions[1])->stream()->__toString());
        }

        $filename = $this->random_string(32) . '.' . $photo->getClientOriginalExtension();

        Photo::create([
            'bid_id' => $bid_id,
            'format' => 'original',
            'filename' => $filename
        ]);

        Storage::disk('public')->put($this->getStorageDirectory($bid_id) . '/' . $filename, Image::make($photo)->stream()->__toString());
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
