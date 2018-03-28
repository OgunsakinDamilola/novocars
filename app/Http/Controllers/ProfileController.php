<?php

namespace App\Http\Controllers;

use App\Mail\PasswordChange;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use nilsenj\Toastr\Facades\Toastr;
use Exception;

class ProfileController extends Controller
{
    public function index(){
        $userInfo = auth()->user();
        return view('pages.others.profile',compact('userInfo'));
    }

    public function updateUserProfile(Request $r){

          $this->validate($r,[
              'customer_first_name'    => 'required|string|max:255',
              'customer_middle_name'   => 'required|string|max:255',
              'customer_last_name'     => 'required|string|max:255',
              'customer_phone_number'  => 'required|digits:11',
              'customer_address'       => 'required',
          ]);

        $user = User::find(auth()->user()->id);
        $user->first_name = $r->customer_first_name;
        $user->middle_name = $r->customer_middle_name;
        $user->last_name = $r->customer_last_name;
        $user->phone = $r->customer_phone_number;
        $user->address = $r->customer_address;
        $update = $user->update();
        if($update){
            return $user;
        }
        return 0;

    }

    public function updateUserProfilePassword(Request $r){
        $this->validate($r,[
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($r->password);
        $update = $user->update();
        if($update){
            Mail::to($user)->send(new PasswordChange($user,$r->password));
            return $user;
        }
        return 0;
    }

    public function updateUserProfileImage(Request $r){
        $file      = $r->file('customer_profile_photo');
        $fileName  = time().$file->getClientOriginalName();
        $file_path = 'images/users/profile/'.$fileName;
        $file->move(public_path('/images/users/profile/'),$fileName);
        $user = User::find(auth()->user()->id);
        $user->profile_photo = $file_path;
        $update = $user->update();

        if($update){
            Toastr::success("Your profile image has been changed successfully");
        }else{
            Toastr::error("Sorry, unable to change your profile image");
        }

        return back();
    }

    public function updateProfileImageJs(Request $r){

        $file      = $r->file('customer_profile_photo');
        $fileName  = time().$file->getClientOriginalName();
        $file_path = 'images/users/profile/'.$fileName;
        $file->move(public_path('/images/users/profile/'),$fileName);
        $user = User::find(auth()->user()->id);
        $user->profile_photo = $file_path;
        $update = $user->update();

        if($update){
            return $user;
        }else{
            return 0;
        }

    }

}
