<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
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
                //create code
                $code = ActiveCode::GenerateCode($request->user());

                $request->session()->flash('phone',$data['phone']);
                //send code


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
    public function getauthphone(Request $request)
    {
        if (! request()->session()->has('phone'))
        {
            return redirect(route('towfactorauth'));
        }
        $request->session()->reflash();

        return view('user.profile.phoneauth');
    }
    public function postauthphone(Request  $request)
    {
        $request->validate([

            'token'=>'required'

        ]);

        if(! $request->session()->has('phone')) {
            return redirect(route('towfactorauth'));
        }



        $status=ActiveCode::VerifyCode($request->token ,$request->user());

        if ($status)
        {
            $request->user()->activeCode()->delete();
            $request->user()->update([
                'phone_number'=>$request->session()->get('phone'),
                'two_factor_type'=>'sms'
            ]);

            alert()->success('کد تایید ثبت شد ','عملیات موفق');

        }else{
            alert()->error('کد تایید اشتباه ','عملیات ناموفق');
        }
        return redirect(route('towfactorauth'));

    }
}
