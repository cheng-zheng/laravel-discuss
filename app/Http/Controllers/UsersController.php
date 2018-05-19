<?php

namespace App\Http\Controllers;


//use Illuminate\Http\Requests;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    //注册page
    public function register()
    {
        return view('users.register');
    }
    //登录page
    public function login()
    {
        return view('users.login');
    }
    //更改头像页面
    public function avatar()
    {
        return view('users.avatar');
    }
    /**
     * @param UserLoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\think\response\Redirect
     *
     */
    public function signing(UserLoginRequest $request)
    {
        if(\Auth::attempt([
            'email' => $request->get('email'),
            'password'=>$request->get('password'),
        ])){
            return redirect('/');
        }

        \Session::flash('user_login_failed','邮箱或密码错误');
        return redirect('/user/login')->withInput();
    }

    /**
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\think\response\Redirect
     * 注册后保存
     */
    public function store(UserRegisterRequest $request)
    {
       // dd($request->all());
        //保存用户数据，重定向
        User::create( array_merge($request->all(),['avatar'=>'/images/default-avatar.png']) );//avatar默认头像
        //send email
        return redirect('/');
    }
    public function changeAvatar(Request $request)//创建头像
    {
        $file = $request->file('avatar');
        //验证image类型
//        $input = array('image' => $file);
//        $rules = array(
//            'image' => 'image'
//        );
//        $validator = Validator::make($input, $rules);
//        if ( $validator->fails() ) {
//            return \Response::json([
//                'success' => false,
//                'errors' => $validator->getMessageBag()->toArray()
//            ]);
//        }
        $destinationPath = 'uploads/';
        //$filename = \Auth::user()->id.'_'.$file->getClientOriginalName();
        $filename = \Auth::user()->id.'_avatar_'.$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        //图像裁剪
        Image::make($destinationPath.$filename)->fit(200)->save();
        $user = User::find(\Auth::user()->id);
        $user->avatar = '/'.$destinationPath.$filename;

        $user->save();

//        return \Response::json([
//            'success' => true,
//            'avatar' => asset($destinationPath.$filename),
//        ]);
        return redirect('/user/avatar');
    }
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\think\response\Redirect
     * 退出登录
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }
}
