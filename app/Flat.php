<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    //
    protected $table  = 'flat';
    protected $fillable = [
        'number_of_room',
        'size',
        'unit',
        'location'
    ];

    public static function insertFlat($data, $flat)
    {
        $flat->number_of_room = $data['number_of_room'];
        $flat->size = $data['size'];
        $flat->unit = $data['unit'];
        $flat->location = $data['location'];
        return $flat;
    }

    public function photo()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function item()
    {
        return $this->morphOne('App\Item' , 'item');
    }

    public function reservation()
    {
        return $this->morphMany('App\Reservation', 'reservation');
    }
}
