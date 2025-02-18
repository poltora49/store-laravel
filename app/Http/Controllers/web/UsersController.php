<?php

namespace App\Http\Controllers\Web;


use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Favorite;
use App\Http\Requests\ChangeEmailForm;
use App\Http\Requests\ProfileForm;
use App\Http\Requests\ChangePasswordForm;

class UsersController extends Controller
{
    public function profile()
    {
        return view('Web.users.profile');
    }


    public function profile_edit(ProfileForm $request)
    {
        try {
        $user = auth()->user();
        if(($request->has("thumbnail")) and ($user->thumbnail!=null)){
            $this->deleteImage($user);
        }
        $user->update($this->saveImage($request,'user'));
        return back()->with('success', "Changed Successfully");
        } catch (\Exception $e) {
            return  redirect()->back()->with('error', "Oops, something went wrong");
        }

    }
    public function change_email(ChangeEmailForm $request){
        try {
        $user= auth()->user();
        $user->email_verified_at = null;
        $user->email = $request->validated()['email'];
        $user->save();
        return  redirect()->back()->with('success', "Changed Successfully, please verified email");
        } catch (\Exception $e) {
            return  redirect()->back()->with('error', "Oops, something went wrong");
        }
    }
    public function change_password(ChangePasswordForm $request)
    {
        try {
        $request->validated();

        $user = auth()->user();
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
        return redirect()->back()->with('success', "Password Changed Successfully");
        } catch (\Exception $e) {
            return  redirect()->back()->with('error', "Oops, something went wrong");
        }
    }



    public function favorites()
    {
        $favorites=Favorite::get(auth()->user()->id)->paginate(12);
        return view('Web.users.favorites',[
            'favorites'=>$favorites,
        ]);
    }

    public function addToFavorite(Request $request)
    {
        $request = Validator::make($request->all(), [
            'id' => ['required','exists:products,id'],
        ])->safe()->all();
        Favorite::add($request['id'], auth()->user()->id);
        // return response()->json('status' =>, 200, $headers);
    }
    public function removeFromFavorite(Request $request)
    {
        $request = Validator::make($request->all(), [
            'id' => ['required','exists:products,id'],
        ])->safe()->all();
        Favorite::remove($request['id']);
        // return response()->json('status' =>, 200, $headers);
    }
    public function clearFavorite()
    {
        try {
        Favorite::flush(auth()->user()->id);
        return redirect()->back();

        } catch (\Exception $e) {
            return  redirect()->back()->with('error', "Oops, something went wrong");
        }
    }



    protected function deleteImage($user){
        if(Storage::disk('public')->exists('user/'.$user->thumbnail)){
            Storage::disk('public')->delete('user/'.$user->thumbnail);
            /*
                Delete Multiple files this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }
    }

    protected function saveImage (ProfileForm $request,$model)
    {
        $data = $request->validated();
        if($request->has("thumbnail")){
            $thumbnail = str_replace("public/".$model,"",$request->file("thumbnail")->store("public/".$model));
            $data["thumbnail"] = $thumbnail;
        }
        return $data;
    }
}

