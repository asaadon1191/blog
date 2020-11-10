<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\authRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegsterRequest;

class AuthController extends Controller
{
    public function regsterForm()
    {
        return \view('users.regster');
    }

    public function regster(RegsterRequest $request)
    {
        // return $request;

        try 
        {
            $user  = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);

                return \redirect()->route('loginForm');

        } catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->back();
        }

    }

    public function loginForm()
    {
        return \view('users.login');
    }

   

    public function login(authRequest $request)
    {
        // return $request;
        if(Auth::attempt(['email' =>$request->email,'password' =>$request->password]))
        {
            return redirect()->route('Dashboard');
        }
        return back()->with(['error' => 'البيانت غير صحيحة']);
    }
}
