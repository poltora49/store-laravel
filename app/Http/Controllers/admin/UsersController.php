<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileForm;
use App\Http\Requests\ChangePasswordForm;
use App\Http\Requests\ChangeEmailForm;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->get();

        return view('admin.users.index', [
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create',[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show',[
            "user" => $user,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.create',[
        "user" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileForm $request, User $user)
    {
        if(($request->has("thumbnail")) and ($user->thumbnail!=null)){
            $this->deleteImage($user);
        }
        $user->update($this->saveImage($request,'user'));
        return back()->with('success', "Changed Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->deleteImage($user);
        $user->delete();
        return redirect(route('user.index',['success' => "Delete Successfully"]));
    }

    public function block($user_id){
        $user=User::find($user_id);
        $user->status=!$user->status;
        $user->save();
        return redirect()->back()->with('success', "Block Successfully");
    }

    public function change_email(ChangeEmailForm $request, $user_id){
        $user=User::find($user_id);
        $user->email = $request->validated()['email'];
        $user->save();
        return  redirect()->back()->with('success', "Changed Successfully");
    }

    public function change_password(ChangePasswordForm $request, $user_id)
    {
        $user=User::find($user_id);

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
