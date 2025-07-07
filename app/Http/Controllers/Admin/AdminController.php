<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverProfile;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function index(){
   $totalorders = Job::count();
   $activedriver = DriverProfile::where('driver_status', 'active')->count();
   $pendingorder = Job::where('delivery_status', 'pending')->count();
   $cancelledorder = Job::where('delivery_status', 'cancelled')->count();
   $alljobs = Job::where('driver_id', Auth::id())->get();

   return view('admin.dashboard', compact('alljobs', 'totalorders', 'activedriver', 'pendingorder', 'cancelledorder'));

   }
}
