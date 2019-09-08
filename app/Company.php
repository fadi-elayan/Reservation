<?php

namespace App;

//use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public  function photo()
    {
        return $this->morphOne('App\Image', 'imageable');
    }



    public function addinformation($requset , $id)
    {
        $data = $requset->all();
        $company = User::find($id);
        $information = new CompanyInformation();
        CompanyInformation::uploadInformation($data , $information);
        $company->userInformation()->save($information);
        $company->image()->save(Image::uploadPhoto($requset->file('file')));
    }

    public static function showAll()
    {
        return DB::table('users')->where('is_a' , 2)->paginate(10);
    }


}
