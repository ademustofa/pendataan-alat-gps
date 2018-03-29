<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Gps_admin;
use App\User;
use Auth;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin');
    }

    public function getUser()
    {
        return view('admin.user');
    }

    public function manageGps()
    {
        return view('admin.data-gps-admin');
    }

    public function getAllGps()
    {
         $gps = Gps_admin::all();

        return response()->json($gps);
    }

     public function createGps(Request $request)
    {
        $gps = new Gps_admin;
        $gps->brand_gps     = $request->brand;
        $gps->model_gps     = $request->model;
        $gps->gps_name      = $request->name;
        $gps->waranty_month = $request->garansi;
        $gps->buy_date      = $request->buyDate;
        $gps->sold_date     = $request->soldDate;
        $gps->sold_to       = $request->soldTo;

       if($request->hasFile('file')) {
            $image = $request->file('file');
            $path = public_path(). '/image/';
            $filename = $image->getClientOriginalName();
            $image->move($path, $filename);

            $gps->photo = $filename;
        }
        
        $gps->description   = $request->desc;
        $gps->save();

    }

    public function updateGps(Request $request)
    {
        /*dd($request->brand);*/

        $id = $request->id;

        $data = Gps_admin::find($id);
        $data->brand_gps     = $request->brand;
        $data->model_gps     = $request->model;
        $data->gps_name      = $request->name;
        $data->waranty_month = $request->garansi;
        $data->buy_date      = $request->buyDate;
        $data->sold_date     = $request->soldDate;
        $data->sold_to       = $request->soldTo;

       if($request->hasFile('file')) {
            $image = $request->file('file');
            $path = public_path(). '/image/';
            $filename = $image->getClientOriginalName();
            $image->move($path, $filename);

            $data->photo = $filename;
        }
        
        $data->description   = $request->desc;
        $data->save();
    }

    public function deleteGps($id)
    {
        $data = Gps_admin::find($id);
        $data->delete();
    }

    public function getDataUser()
    {
        $data = User::all();

        return response()->json($data); 
    }

    public function createUser(Request $request)
    {
        $user = new User;
        $user->name     = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

    }

    public function updateUser(Request $request)
    {
        /*$data = json_decode($request->getContent(), true);*/
        $id = $request->id;

        $user = User::find($id);
        $user->name     = $request->username;
        $user->email    = $request->email;

        $user->save();
    }

    public function deleteUser(Request $request)
    {
       /* $data = json_decode($request->getContent(), true);*/
        $id = $request->id;

        $user = User::find($id);
        $user->delete();
    }

}
