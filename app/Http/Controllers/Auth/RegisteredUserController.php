<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\DriverProfile;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone_number' => ['required', 'digits:11'],
        'role' => ['required', 'string'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    if ($request->role === 'Admin') {
        $request->validate([
            'access_code' => ['required', 'string'],
        ]);

        if ($request->access_code !== env('ADMIN_ACCESS_CODE')) {
            return back()->withErrors(['access_code' => 'Invalid admin access code'])->withInput();
        }
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);

    if ($request->role === 'Driver') {
        $request->validate([
            'license_number' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        DriverProfile::create([
            'user_id' => $user->id,
            'license_number' => $request->license_number,
            'address' => $request->address,
            'availability_status' => 'available',
            'rating' => null,
        ]);
    }

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('dashboard'));
}
}
