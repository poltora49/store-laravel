<?php

namespace App\Http\Controllers\web;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Favorite;
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
        if(($request->has("thumbnail")) and ($user->thumbnail!=null)){
            $this->deleteImage($product);
        }
        if(Auth::user()->id == $user->id){

            $user->update($this->saveImage($request,'user'));

            return back()->with('success', "Changed Successfully");
        }
        return back()->with('Error', "It`s not your account");

    }
    public function change_password(ChangePasswordForm $request, User $user){

        $request->validated();

	// The passwords matches
        if (!Hash::check($request->get('password'), $user->password))
        {
            return back()->with('error', "Current Password is Invalid");
        }

    // Current password and new password same
        if (strcmp($request->get('password'), $request->get('new_password')) == 0)
        {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }



    public function favorites()
    {
        $favorites=Favorite::get(auth()->user()->id);
        return view('web.users.favorites',[
            'favorites'=>$favorites,
        ]);
    }

    public function addToFavorite(Request $request)
    {
        Favorite::add($request->input('id'), auth()->user()->id);
        // return response()->json('status' =>, 200, $headers);
    }
    public function removeFromFavorite(Request $request)
    {
        Favorite::remove($request->input('id'));
        // return response()->json('status' =>, 200, $headers);
    }
    public function clearFavorite()
    {
        Favorite::flush(auth()->user()->id);
        return redirect()->back();
    }


    protected function deleteImage($product){
        if(Storage::disk('public')->exists('user/'.$product->thumbnail)){
            Storage::disk('public')->delete('user/'.$product->thumbnail);
            /*
                Delete Multiple files this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }
    }

    protected function saveImage (ProductForm $request,$model)
    {
        $data = $request->validated();
        if($request->has("thumbnail")){
            $thumbnail = str_replace("public/".$model,"",$request->file("thumbnail")->store("public/".$model));
            $data["thumbnail"] = $thumbnail;
        }
        return $data;
    }
}

