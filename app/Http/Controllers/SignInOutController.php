<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Hash;
use Redirect;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class SignInOutController extends Controller
{
    public function Sign()
    {
        return view('sign');
    }
    public function SignIn(Request $request)
    {
        $list = $request->all();
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'vcode' => 'required|captcha',
        ];

        $validator = Validator::make($list, $rules);

        if ($validator->passes()) {
            $attempt = Auth::attempt([
                'email' => $list['email'],
                'password' => $list['password']
            ]);

            if ($attempt) {
                $rows = DB::select('SELECT username FROM members2 WHERE email="' . $list['email'] . '"');
                $username = "";
                foreach($rows as $row){
                    $username=$row->username;
                }
                Session::put('username',$username);
                return redirect('/home');
            }

            return Redirect::to('sign')
                ->withErrors(['fail' => '帳號密碼或驗證碼錯誤'])
                ->withInput(Input::except('password'));
        }
        // fails
        return Redirect::to('sign')
            ->withErrors(['fail' => '帳號密碼或驗證碼錯誤'])
            ->withInput(Input::except('password'));
    }
    public function Register()
    {
        return view('register');
    }
    public function NewRegister(Request $request)
    {
        $list = $request->all();
        //驗證是否有輸入正確
        $rules = [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $msg = [
            'password' => '密碼請輸入八碼以上',
        ];
        $validator = Validator::make($list, $rules, $msg);
        //新增前確認
        if ($validator->passes()) {
            // 正確進入確認email重複
            $checkemail = $request->email;
            $doubleemail = DB::select('select * from members2 where email = "' . $checkemail . '"', [1]);
            if ($doubleemail) {
                return Redirect::to('/newregister')
                    ->withErrors(['fail' => '信箱重複註冊']);
            } else {
                //新增
                DB::table('members2')->insert([
                    'username' => $request->username,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                //確認新增成功則導向
                if (DB::select('select * from members2 where email = "' . $checkemail . '"', [1])) {
                    Session::flash('success', "");
                    return Redirect::to('sign');
                }
                //沒成功則回去繼續新增
                return Redirect::to('/newregister')
                    ->withErrors(['fail' => '新增失敗'])
                    ->withInput(Input::except(['password', 'vcode']));
            }
        }
        //驗證失敗
        if ($validator->fails()) {
            return Redirect::to('/newregister')
                ->withErrors(['fail' => '密碼至少八碼'])
                ->withInput(Input::except(['password', 'vcode']));
        }
        return Redirect::to('/newregister')
            ->withErrors($validator)
            ->withInput(Input::except('password'));
    }
    public function SignOut()
    {
        Auth::logout();
        return redirect('/sign');
    }
}
