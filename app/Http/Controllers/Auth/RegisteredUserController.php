<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $liste_roles = Role::all();
        $liste_promos = Promotion::all();

        return view('auth.register', [
            'Roles' => $liste_roles,
            'Promos' => $liste_promos,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'birthDay' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phoneNumber' => 'required',
            'role_id' => 'required',
            'promotion_id' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $user = User::create([
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'birthDay' => $request->birthDay,
            'email' => $request->email,
            'phoneNumber' => $request->email,
            'role_id' => $request->role_id,
            'promotion_id' => $request->promotion_id,
            'password' => Hash::make($request->password),
            'state' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
