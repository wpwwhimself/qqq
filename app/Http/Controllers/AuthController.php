<?php

namespace App\Http\Controllers;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view("pages.auth.login");
    }

    public function login(Request $rq)
    {
        $rq->validate(['password' => ['required']]);

        $password = trim($rq->password);
        $remember = $rq->has("remember");

        foreach (User::all() as $user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user, $remember);
                $rq->session()->regenerate();

                return ($password === DatabaseSeeder::BASE_PASSWORD)
                    ? view("pages.auth.change-password")
                    : redirect()->intended()->with("success", "Zalogowano");
            }
        }

        return back()->with("error", "Nieprawidłowe dane logowania");
    }

    public function changePassword(Request $rq){
        $validator = Validator::make($rq->all(), [
            'password' => ['required', 'confirmed'],
        ]);
        if ($validator->fails()) return view("pages.auth.change-password")->with("error", "Coś jest nie tak z hasłem");

        User::findOrFail(Auth::id())->update([
            "password" => Hash::make($rq->password),
        ]);

        return redirect()->route("home")->with("success", "Hasło zmienione");
    }

    public function logout(Request $rq){
        Auth::logout();
        $rq->session()->invalidate();
        $rq->session()->regenerateToken();
        return redirect()->route("home")->with("success", "Wylogowano");
    }
}
