<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    protected $table = 'companyInformation';

    protected $fillable = [
      'location',
        'map',
        'number'
    ];


    public static function uploadInformation (array $data , $inforamtion)
    {

        $inforamtion->location = $data['location'];
        $inforamtion->map = $data['map'];
        $inforamtion->number = $data['number'];

    }

}
