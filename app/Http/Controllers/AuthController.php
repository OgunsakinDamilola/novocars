<?php

namespace App\Http\Controllers;

use App\Mail\SuccessfulRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use nilsenj\Toastr\Facades\Toastr;

class AuthController extends Controller
{

    public function login(Request $request) {

        if (Auth::attempt ( array (
            'email' => $request->get ( 'email' ),
            'password' => $request->get ( 'password' )
        ) )) {
            session ( [
                'email' => $request->get ( 'email' )
            ] );
            return response()->json($this->guard()->user(), 200);

        } else {
            return response()->json(false);
        }
    }

    public function addMember(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

       $password = str_random(8);

        $user = User::create([
            'middle_name' => $request->middle_nanme,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone_number,
            'address' => '',
            'profile_photo' => '',
            'date_of_birth' => '',
            'password' => bcrypt($password)
        ]);

        if ($user)
        {

            DB::table('role_user')->insert([
                'user_id'=>$user->id,
                'role_id'=>2
            ]);
        }

        $this->guard()->login($user);

            try{
              Mail::to($user)->send(new SuccessfulRegistration($user,$password));
            }catch(Exception $e){
                Toastr::error("Sorry, unable to send successful registration email");
            }
            return response()->json($this->guard()->user(), 200);
    }

    public function guard()
    {
        return Auth::guard();
    }

}
