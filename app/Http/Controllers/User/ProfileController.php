<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.profile');
    }

    public function towfactorauth()
    {
        return view('user.profile.towfactorauth');
    }

    public function posttowfactorauth(Request $request)
    {
        $data=$request->validate(
            [
                'type'=>'required|in:sms,off',
                'phone'=>'required_unless:type,off'

            ]
        );

        if ($data['type']==='sms')
        {
            //Validate sms

            if($request->user()->phone_number !== $data['phone'])
            {
                return redirect(route('profile.phone'));
            }
            else
            {
                $request->user()->update([
                    'tow_factor_type'=>'sms'
                ]);
            }
        }
        if ($data['type']==='off')
        {
            $request->user()->update([
                'two_factor_type'=>'off'
            ]);
        }

        return back();




    }
    public function getauthphone()
    {
        return view('user.profile.phoneauth');
    }
    public function postauthphone(Request  $request)
    {
        $request->validate([

            'token'=>'required'

        ]);
        return $request->token;

    }
}
