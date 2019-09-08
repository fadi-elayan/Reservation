<?php

namespace App\Http\Controllers;

use App\Http\Requests\RejecterRequest;
use App\Image;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Admin');
    }


    public function index()
    {
        return view('Admin.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RejecterRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemController = new ItemController();
        $company  = User::find($id);
        $itmes = $company->item;
        foreach ($itmes as  $itme)
        {
            $itemController->destroy($itme->id);
        }
        $company->userInformation->delete();
        if($company->image->path == '125.png')
            $company->image->delete();
        else
            Image::deleteImage($company->image);
        $company->delete();
        return redirect(url('/Admin'));
    }
}
