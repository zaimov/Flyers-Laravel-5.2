<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlyerRequest;
use Illuminate\Http\Request;
use App\Flyer;
use App\Photo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FlyersController extends Controller
{
    public function create()
    {
        return view('flyers.create');
    }

    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());
        
        return redirect()->back();
    }

    public function show($zip, $street)
    {
		$flyer = Flyer::locatedAt($zip, $street);

		return view('flyers.show', compact('flyer'));    	
    }

    public function addPhoto($zip, $street, Request $request)
    {
        /*$this->validate($request, [
            'photo' => 'required|mimes: jpg, jpeg, png'
        ]);*/

        // $file = $request->file('photo');

       // $name = time() . $file->getClientOriginalName();

        // $file->move('flyers/photos', $name);

        $photo = Photo::fromForm($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

       // $flyer->photos()->create(['path' => "/flyers/photos/{$name}"]);
    }
}
