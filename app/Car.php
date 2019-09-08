<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //

    protected $table = 'car';

    protected $fillable = [
        'type',
        'color',
        'board_number'
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


    public static function insertCar($data , $carObj)
    {
        $carObj->type = $data['type'];
        $carObj->color = $data['color'];
        $carObj->board_number = $data['board_number'];
        return $carObj;
    }

}
