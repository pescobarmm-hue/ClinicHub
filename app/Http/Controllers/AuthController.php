<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesar login normal
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Procesar registro normal
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        $user = User::create([
            'name' => $validated['name'] . ' ' . $validated['lastname'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Redirigir a proveedor social (Google/GitHub)
    public function redirectToProvider(string $provider)
    {
        $validProviders = ['google', 'github'];

        if (!in_array($provider, $validProviders)) {
            return redirect('/login')->with('error', 'Proveedor no válido');
        }

        return Socialite::driver($provider)->redirect();
    }

    // Callback de proveedor social
    public function handleProviderCallback(string $provider)
    {
        $validProviders = ['google', 'github'];

        if (!in_array($provider, $validProviders)) {
            return redirect('/login')->with('error', 'Proveedor no válido');
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName() ?? 'Usuario Social',
                    'password' => bcrypt(Str::random(24)),
                    "{$provider}_id" => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'email_verified_at' => now(),
                ]
            );

            if (empty($user->{"{$provider}_id"})) {
                $user->update(["{$provider}_id" => $socialUser->getId()]);
            }

            Auth::login($user, true);
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            Log::error("Error en autenticación con {$provider}: " . $e->getMessage());
            return redirect('/login')->with('error', 'Error al autenticar con ' . ucfirst($provider));
        }
    }
}
