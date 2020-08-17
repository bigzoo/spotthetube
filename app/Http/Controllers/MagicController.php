<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

class MagicController extends Controller
{
    public function index(Request $request)
    {
        $session = Session::find($request->session()->get('user_token'));
        if (!$session) {
            return redirect()->route('home');
        } else {
            $session = $session->token;
        }
        return view('magic', compact('session'));
    }
}
