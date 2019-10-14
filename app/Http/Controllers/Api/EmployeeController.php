<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Employee;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $employees = Employee::all();
       return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required | max:255',
            'email'=>'required |email | unique:employees',
            'phone'=>'required | unique:employees',
            'address'=>'required',
            'nid_number'=>'required',
            'join_date'=>'required',
            'salary'=>'required',
            'gander'=>'required'
        ]);
        $image = $request->photo;
        $slug = str_slug($request->name);
        if($image){
         $position = strpos($image, ';');
         $sub = substr($image, 0,$position);
         $ex = explode('/', $sub)[1];
         
         
         $currentDate = Carbon::now()->toDateString();
         $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$ex;
         $sizImg = Image::make($image)->resize(240,200);
         $uploadPath = 'backend/employees/';
         $imageUrl = $uploadPath.$imageName;
         $sizImg->save($imageUrl);

         $employees = new Employee();

         $employees->name = $request->name;
         $employees->email = $request->email;
         $employees->phone = $request->phone;
         $employees->address = $request->address;
         $employees->nid_number = $request->nid_number;
         $employees->join_date = $request->join_date;
         $employees->salary = $request->salary;
         $employees->gander = $request->gander;
         $employees->photo = $imageUrl;

         $employees->save();

     }else{
         $employees = new Employee();

         $employees->name = $request->name;
         $employees->email = $request->email;
         $employees->phone = $request->phone;
         $employees->address = $request->address;
         $employees->nid_number = $request->nid_number;
         $employees->join_date = $request->join_date;
         $employees->salary = $request->salary;
         $employees->gander = $request->gander;
         $employees->save();
     }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Responsee
     */
    public function show($id)
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
        //
    }
}
