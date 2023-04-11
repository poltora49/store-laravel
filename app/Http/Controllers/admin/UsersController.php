<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileForm;
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
        $data = $this->saveImage($request,'user');
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
        return redirect(route('user.index'));
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
