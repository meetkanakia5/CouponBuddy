<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\SpecificDomainsOnly;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
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
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new SpecificDomainsOnly],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), Password::min(8)->numbers()->mixedCase()->symbols()],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'address' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'regex:/^(?<full>(?<part1>[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1})(?:[ ](?=\d))?(?<part2>\d{1}[A-Z]{1}\d{1}))$/'],
            'direction' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'direction' => $request->direction,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
