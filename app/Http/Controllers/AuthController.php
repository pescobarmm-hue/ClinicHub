<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Muestra el formulario de registro
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Procesa el login con email/password
     */
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

    /**
     * Procesa el registro con email/password
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    /**
     * Redirige al proveedor social (Google o GitHub)
     */
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, ['google', 'github'])) {
            return redirect('/')->with('error', 'Proveedor no válido');
        }
        
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Maneja el callback del proveedor social
     */
    public function handleProviderCallback($provider)
    {
        try {
            if (!in_array($provider, ['google', 'github'])) {
                return redirect('/')->with('error', 'Proveedor no válido');
            }
            
            $socialUser = Socialite::driver($provider)->user();
            
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if ($user) {
                $this->updateProviderId($user, $provider, $socialUser->getId());
                Auth::login($user);
                return redirect()->intended('/dashboard');
            }
            
            if (empty($socialUser->getEmail())) {
                session([
                    'social_provider' => $provider,
                    'social_id' => $socialUser->getId(),
                    'social_name' => $socialUser->getName(),
                    'social_avatar' => $socialUser->getAvatar(),
                ]);
                return redirect()->route('social.email.form');
            }
            
            $user = $this->createSocialUser($socialUser, $provider);
            Auth::login($user);
            
            return redirect()->intended('/dashboard');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error al autenticar: ' . $e->getMessage());
        }
    }

    /**
     * Muestra formulario para pedir email (caso GitHub sin email público)
     */
    public function showEmailForm()
    {
        if (!session()->has('social_provider')) {
            return redirect('/');
        }
        
        return view('auth.social-email');
    }

    /**
     * Guarda el email proporcionado por el usuario
     */
    public function storeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);
        
        $user = User::create([
            'name' => session('social_name'),
            'email' => $request->email,
            'google_id' => session('social_provider') === 'google' ? session('social_id') : null,
            'github_id' => session('social_provider') === 'github' ? session('social_id') : null,
            'avatar' => session('social_avatar'),
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(24)),
        ]);
        
        session()->forget(['social_provider', 'social_id', 'social_name', 'social_avatar']);
        
        Auth::login($user);
        
        return redirect('/dashboard')->with('success', '¡Registro completado con éxito!');
    }

    /**
     * Crea un nuevo usuario con datos del proveedor social
     */
    private function createSocialUser($socialUser, $provider)
    {
        $data = [
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'avatar' => $socialUser->getAvatar(),
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(24)),
        ];
        
        if ($provider === 'google') {
            $data['google_id'] = $socialUser->getId();
        } elseif ($provider === 'github') {
            $data['github_id'] = $socialUser->getId();
        }
        
        return User::create($data);
    }

    /**
     * Actualiza el provider_id si el usuario no lo tiene
     */
    private function updateProviderId($user, $provider, $providerId)
    {
        $field = $provider === 'google' ? 'google_id' : 'github_id';
        
        if (empty($user->$field)) {
            $user->$field = $providerId;
            $user->save();
        }
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}