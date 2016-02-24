<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    //protected $baseDir = '/fls/photos';

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public static function named($name)
    {
    	$photo = new static;

        return $photo->saveAs($name);

    	//$name = time() . $file->getClientOriginalName();
    	//$photo->path = '/fls/photos/' . $name;
    }

    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("fls/photos/%s", $this->name);
        $this->thumbnail_path = sprintf("fls/photos/tn-%s", $this->name);

        return $this;
    }

    public function move(UploadedFile $file)
    {
    	$file->move('fls/photos', $this->name);

        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);

            return $this;
    }
}
