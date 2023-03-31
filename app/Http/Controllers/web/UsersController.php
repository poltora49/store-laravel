<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\ProfileForm;
use App\Http\Requests\ChangePasswordForm;

class UsersController extends Controller
{
    public function profile()
    {
        return view('web.users.profile');
    }

    public function profile_edit(ProfileForm $request, User $user)
    {
        $auth = auth()->user();

        $date = $this->saveImage($request,'user');
        if (!Hash::check($request->get('password'), $auth->password))
        {
            return back()->with('error', "Password is Invalid");
        }
        $user =  User::find($auth->id);
        if($request['thumbnail']){
            $user->update([
                'name' => $date['name'],
                'email' => $date['email'],
                'thumbnail' => $date['thumbnail'],
                'updated_at' => now()
            ]);
        }
        else{
            $user->update([
                'name' => $date['name'],
                'email' => $date['email'],
                'updated_at' => now()
            ]);
        }
        return back()->with('success', "Password Changed Successfully");
    }
    public function change_password(ChangePasswordForm $request, User $user){

        $request->validated();

        $auth = auth()->user();

	// The passwords matches
        if (!Hash::check($request->get('password'), $auth->password))
        {
            return back()->with('error', "Current Password is Invalid");
        }

    // Current password and new password same
        if (strcmp($request->get('password'), $request->get('new_password')) == 0)
        {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }

    public function favorites()
    {
        return view('web.users.favorites');
    }

    protected function saveImage (ProfileForm $request,$model)
    {
        $data = $request->validated();
        if($request->has("thumbnail")){
            $thumbnail = str_replace("public/","",$request->file("thumbnail")->store("public/".$model));
            $data["thumbnail"] = $thumbnail;
        }
        return $data;
    }
}
