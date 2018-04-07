<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use Validator;

class ChangePasswordController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function adminCredentialRules(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];
        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);
        return $validator;
    }
    public function postCredentials(Request $request)
    {
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->adminCredentialRules($request_data);
            if($validator->fails())
            {
                return redirect()->back()->with('pw-er', 'Error!');
            }
            else
            {
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['current-password'], $current_password))
                {
                    $user = Auth::User();
//                    return $user;
//                    $obj_user = User::find($user_id);
                    $user->password = Hash::make($request_data['password']);;
                    $user->save();
                    return redirect()->back()->with('mes', 'Changed password!');
                }
                else
                {
                    return redirect()->back()->with('er', 'Error!');
                }
            }
        }
        else
        {
            return redirect()->back();
        }
    }
}
