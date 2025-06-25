<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Job;

class ClientController extends Controller
{
    public function dashboard(){
        return view('client.dashboard');
    }

    public function book(){
        $client = Auth::user();
        $clientinfo = User::find($client->id);
        if (!$client) {
            return redirect()->route('login')->with('error', 'You must be logged in to book a ride.');
        }
        return view('client.book.book', compact('client', 'clientinfo'));
    }

    public function storeBooking(Request $request){
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'client_name'=> 'required|string|max:255',
            'client_contact' => 'required|string|max:15',
            'pickup_address' => 'required|string|max:255',
            'dropoff_address' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:50',
            'distance_km'=> 'required',
            'price_php'=> 'required',
            'package_description' => 'required|string|max:255',
            'scheduled_time' => 'required',
        ]);

        Job::create([
            'client_id'=> $request->client_id,
            'client_name'=> $request->client_name,
            'client_contact'=> $request->client_contact,
            'pickup_address'=> $request->pickup_address,
            'dropoff_address'=> $request->dropoff_address,
            'vehicle_type'=> $request->vehicle_type,
            'distance'=> $request->distance_km,
            'price'=> $request->price_php,
            'package_description'=> $request->package_description,
            'scheduled_time'=> $request->scheduled_time,
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Booking successfully created!');
    }
}
