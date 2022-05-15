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
        }
        if ($data['type']==='off')
        {
            $request->user()->update([
                'two_factor_type'=>'off'
            ]);
        }

        return back();


    }
}
