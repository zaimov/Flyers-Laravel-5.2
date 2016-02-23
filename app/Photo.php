<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path'];

    //protected $baseDir = '/fls/photos';

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public static function fromForm(UploadedFile $file)
    {
    	$photo = new static;

    	$name = time() . $file->getClientOriginalName();

    	$photo->path = '/fls/photos/' . $name;

    	$file->move('fls/photos', $name);

    	return $photo;
    }
}
