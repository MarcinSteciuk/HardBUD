<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Reservation;
use App\Models\room;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        if(!Auth::user()->isAdmin()) {
            return redirect()->route('index');
        }

        return view('auth.users', [
            'users' => User::all(),
        ]);
    }


    public function login(): RedirectResponse|View
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'Nieprawidły email lub hasło.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'role_id' => ['required', 'in:2,3'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user = User::findOrFail($user->id);
        foreach (Offer::where('user_id', '=', $user->id)->get() as $offer) {
            foreach (room::where('offer_id', '=', $offer->id)->get() as $room) {
                foreach (Reservation::where('room_id', '=', $room->id)->get() as $reservation) {
                    $reservation->delete();
                }
                $room->delete();
            }
            $offer->delete();
        }
        $user->delete();
        return redirect()->route('auth.index');
    }
}
