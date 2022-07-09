<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordExpiredRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class ExpiredPasswordController extends Controller
{
    public function expired()
    {

        return view('auth.expired-password');

    }

    public function postExpired(PasswordExpiredRequest $request)
    {
        if (!Hash::check($request->current_password, $request->user()->password)) {

            return redirect()->back()->withErrors(['current_password' => Lang::get('main.error_curr_password')]);
        }

        $request->user()->update([

            'password' => bcrypt($request->password),

            'password_changed_at' => Carbon::now()->toDateTimeString()

        ]);

        return redirect()->back()->with(['status' => Lang::get('main.password_save')]);

    }
}
