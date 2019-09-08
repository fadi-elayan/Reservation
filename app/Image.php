<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image' ;
    protected $fillable = ['path'];


    public function imageable()
    {
        return $this->morphTo('imageable');
    }
    public static function uploadPhoto($image)
    {
        $photo = new Image();
        $path = '125.png';
        $date = new DateTime();
        if($files = $image){
            $name = $date->format('u');
            $name .= $files->getClientOriginalName();
            $files->move('image' , $name);
            $file['path'] = $name;
            $path = $file['path'];
        }
        $photo->path = $path;
        return $photo;
    }
    public static function deleteImage($photo)
    {
            if (file_exists('image/'.$photo->path)){
                 unlink('image/'.$photo->path);
            }
            $photo->delete();
    }
}
