<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hold extends Model
{
    protected $table = 'hold';
    protected $fillable = [
        'number_of_armchare',
        'size',
        'unit',
        'location'
    ];


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

    public static function insertHold($data , $hold)
    {
        $hold->number_of_armchare = $data['number_of_armchare'];
        $hold->size = $data['size'];
        $hold->unit = $data['unit'];
        $hold->location = $data['location'];
        return $hold;
    }

}
