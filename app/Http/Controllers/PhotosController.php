<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use App\AddPhotoToFlyer;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function store($zip, $street, Request $request)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();

        /*$this->validate($request, [
            'photo' => 'required|mimes: jpg, jpeg, png'
        ]);*/

        // $file = $request->file('photo');

       // $name = time() . $file->getClientOriginalName();

        // $file->move('flyers/photos', $name);

       // $photo = Photo::fromForm($request->file('photo'));
        /*$photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);*/

       // $flyer->photos()->create(['path' => "/flyers/photos/{$name}"]);
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id)->delete();

        return back();
    }
}
