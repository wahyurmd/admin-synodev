<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function index() : View {
        return view('login');
    }

    function login(Request $request) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $request->session()->regenerate();
                if (Auth::user()->status == '1') {
                    return redirect()->route('home')->with(['success' => 'Logged in successfully.']);
                }
            }

            return redirect()->back()->with(['error' => 'Incorrect email or password.']);
        } catch (\Exception $e) {
            return back()->with('errortoast', ['Login Failed: ' . $e->getMessage()]);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('errortoast', [$e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with(['success' => 'Successfully logged out.']);
    }
}
