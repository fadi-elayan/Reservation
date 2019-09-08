<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyInformation;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\InformationRequest;
use App\Http\Requests\RejecterRequest;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\UploadRequestInf;
use App\Item;
use App\Mail\VerifyMail;
use App\Image;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $date = new Carbon();
        return view('company.profile' , compact('date'));
    }


    public function create()
    {
        return view('company.add');
    }

    public function createInformation($id)
    {
        return view('company.information' , compact('id'));
    }


    public function store(RejecterRequest $request)
    {

        $Rgister = new RegisterController();
        $Rgister->create($request->all() , 2);
        Mail::to($request->input('email'))->send(new VerifyMail());
        return redirect(url('add/information' ,User::where('email' , $request->input('email'))->get()[0]->id));
    }

    public function storeInformatio(InformationRequest $request , $id)
    {
        $request->flash();
        $request->old();
       $company = new Company();
       $company->addinformation($request , $id);
       return redirect('/Admin');
    }


    public function showCompany()
    {
        $company = Company::showAll();
        $data = new Carbon();
        $i = 1;
        return view('company.show' , compact(['company' ,'i' , 'data']));
    }

    public function show($id)
    {
        $item = Item::getItemForUser($id);
        $date = new Carbon();
        return view('Admin.showItemForCompany' , compact(['item','date']));
    }



    public function edit(UploadRequest $request ,$id)
    {
        $company = (User::find($id))->userInformation;
        return view('company.upload' , compact('company'));
    }


    public function update(UploadRequestInf $request, $id)
    {
        $information = CompanyInformation::find($id);
        CompanyInformation::uploadInformation($request->all() , $information);
         $information->save();
        return redirect(url('/company'));
    }


    public function destroy($id)
    {
        //
    }
}
