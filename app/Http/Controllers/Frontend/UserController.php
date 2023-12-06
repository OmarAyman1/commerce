<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('frontend.user.profile');
    }

    public function updateUserDetails(Request $request){

        $request->validate([
            'name'=> ['required','string'],
            'phone' => ['required','digits:10'],
            'pin_code' => ['required','digits:6'],
            'address' => ['required','string', 'max:499'],
        ]);

        $user = User::findOrfail(Auth::user()->id);
        $user->update([
            'name' => $request->name,

        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address
            ]
        );

        return redirect()->back()->with('message','profile updated');
    }
}
