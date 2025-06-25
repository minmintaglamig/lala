<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriverProfile;
use App\Models\User;

class DriverController extends Controller
{
    public function index() {
        return view('drivers.index');
    }
    public function show($id)
{
    $driverprof = DriverProfile::where('user_id', $id)->first(); 
    $driveruser = User::find($id); 

    return view('admin.driver.index', compact('driverprof', 'driveruser'));
}

}
