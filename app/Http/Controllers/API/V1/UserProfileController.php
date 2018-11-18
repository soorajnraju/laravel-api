<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public $successStatus = 200;

    public function create(Request $request){
        $user = Auth::user(); 
        $input = $request->all();
        $input['user_id'] = $user->id;
        UserProfile::create($input);
        return response()->json(['success' => $input], $this-> successStatus);
    }

    public function profile(Request $request){
        $user = Auth::user();
        $profile = UserProfile::find($user->id);
        return response()->json(['success' => $profile], $this-> successStatus);
    }
}
