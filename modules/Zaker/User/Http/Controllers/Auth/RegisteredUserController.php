<?php

namespace Zaker\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Zaker\User\Models\User;
use Zaker\User\Notifications\VerifyEmail;
use Zaker\User\Notifications\VerifyEmailNotification;
use Zaker\User\Rules\ValidateMobile;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('User::Front.register');
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['nullable', 'string','min:9','max:14',new ValidateMobile()],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile'=>$request->mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect()->route('verification.notice');
        //return redirect(RouteServiceProvider::HOME);
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }
}
