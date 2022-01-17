<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;  //fungsi enkirpsi password login 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::Where([['email',$request->email],['password',$request->password]])->first();

        if($user){
            session()->put('email',$user->email);
            session()->put('password',$user->password);
            session()->put('name',$user->name);

            return response()->json(['msg'=> 'Sukses Login.'],200);
        }
        return response()->json(['msg' => 'Password tidak Valid'],401);

        return response()->json(['msg' => 'User atau password tidak valid!'],401);
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
    

}
