<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editProfile(){
        return view('profile.edit-profile');
    }

    public function updateProfile(Request $request){

        $request->validate([
           "name" => "required|min:3|max:50",
           "photo" => "nullable|file|mimes:jpeg,png|max:1000"
        ]);

//        return $request;

        $user = User::find(auth()->id());
        $user->name = $request->name;
        if($request->hasFile('photo')){

            $dir="storage/profile";
            $newName = "profile_".uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs("public/profile",$newName);
            $user->photo = $dir."/".$newName;
        }
        $user->update();
        return redirect()->back();
    }

    public function changePassword(){
        return view('profile.change-password');
    }

    public function updatePassword(Request $request){
        return $request;
    }
}
