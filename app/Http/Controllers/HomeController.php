<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Gps_user;
use App\User;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.home');
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function getName()
    {
        $id = Auth::user()->id;

        $name = User::find($id);

        return response()->json($name);
    }

    public function updateName(Request $request)
    {
        $id = $request->id;

        $profile = User::find($id);
        $profile->name = $request->name;
        $profile->save();
    }

    public function updatePassword(Request $request)
    {
        $id = $request->id;

        $profile = User::find($id);
       
        $profile->password = Hash::make($request->newPassword);
        $profile->save();
    

    }

    public function showDataGps()
    {
        return view('users.data-gps');
    }

    public function getAllGps()
    {
      
        $gps = Gps_user::all();

        return response()->json($gps);
    }

    public function createGps(Request $request)
    {
        $gps = new Gps_user;
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

        $data = Gps_user::find($id);
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
        $data = Gps_user::find($id);
        $data->delete();
    }

}
