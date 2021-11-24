<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                "email" => "required|email",
                "password" => "required"
            ],
            [
                "email.required" => "El correo es requerido",
                "email.email" => "El correo no tiene formato valido",
                "password.required" => "La contraseña es requerida",
            ]
        );

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'El email y/o la contraseña no coinciden.',
            ]);
        }

        if($user->password == NULL)
        {
            return view('auth.newClient', compact($user));
        }

        if ($user->hasVerifiedEmail()) {
            if (Auth::attempt($request->only(['email', 'password']), $request->remember_me ? true : false)) {
                $request->session()->regenerate();

                switch (Auth::user()->rol_id) {
                    case 1:
                        return redirect()->intended('/admin/citas');
                        break;
                    case 2:
                        return redirect()->intended('/abogacia/productos');
                        break;
                    case 3:
                        return redirect()->intended('/cliente/dashboard');
                        break;
                    case 4:
                        return redirect()->intended('/control/dashboard');
                        break;

                    default:
                        # code...
                        break;
                }
            }
        } else {
            return back()->withErrors([
                'email' => 'Su cuenta no ha sido verificada.',
            ]);
        }

        return back()->withErrors([
            'email' => 'El email y/o la contraseña no coinciden.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
