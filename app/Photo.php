<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    // public $file;

    /*public static function boot() 
    {
        static::creating(function($photo) {
            return $photo->upload();
        });
    }*/

    //protected $baseDir = '/fls/photos';

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

/*    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        return $photo->fill([
            'name' => $photo->fileName(),
            'photo' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);
    }*/

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }

    /*public function fileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }*/

   /* public function filePath()
    {
        return 'fls/photos/' . $this->fileName();
    }

    public function thumbnailPath()
    {
        return $this->baseDir() . '/tn-' . $this->fileName();
    }*/

    public function baseDir()
    {
        return 'fls/photos';
    }

    /*public static function named($name)
    {
    	$photo = new static;

        return $photo->saveAs($name);

    	//$name = time() . $file->getClientOriginalName();
    	//$photo->path = '/fls/photos/' . $name;
    }
*/
 /*   protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("fls/photos/%s", $this->name);
        $this->thumbnail_path = sprintf("fls/photos/tn-%s", $this->name);

        return $this;
    }*/

   /* public function upload()
    {
    	//$this->$file->move('fls/photos', $this->file->name);

        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnail_path());

            return $this;
    }*/
}
