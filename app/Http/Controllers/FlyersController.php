<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlyerRequest;
use Illuminate\Http\Request;
use App\Flyer;

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
		$flyer = Flyer::locatedAt($zip, $street)->first();

		return view('flyers.show', compact('flyer'));    	
    }
}
