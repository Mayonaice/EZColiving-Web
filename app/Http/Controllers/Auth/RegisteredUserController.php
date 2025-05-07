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
use App\Providers\RouteServiceProvider;
use Exception;

class RegisteredUserController extends Controller
{
    private const SECRET_CODE = 'Vadodali040903';

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
            'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'secret_code' => ['required', 'string', function ($attribute, $value, $fail) {
                if ($value !== self::SECRET_CODE) {
                    $fail('Kode rahasia tidak valid.');
                }
            }],
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => 'admin',
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Error saat membuat user: ' . $e->getMessage()]);
        }
    }
}
