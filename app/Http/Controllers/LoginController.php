<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function adminlogin(Request $request){
        if($request->isMethod('post')){
            
            $rules=[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $custommessage=[
                'email.required'=>'Email is required',
                'email.email'=>'Email valid!',
                'password.required'=>'password is required'
            ];
            $this->validate($request,$rules,$custommessage);
            if(Auth::guard('admin')->attempt(['email'=>$request->email ,'password'=>$request->password])){
            
                Session::regenerateToken();
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }else{
                return redirect()->back()->with('erorr_message','invalid Email or Password');
            }
        }
    }
    
    public function logout(){
        Auth::guard('admin')->logout();

        Session::invalidate();

       Session::regenerateToken();

        return redirect('/login');
    }
    public function userregister(Request $request){
        if($request->isMethod('post')){
            $rules=[
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required',
                'phone' => 'required|numeric',
                'name' => 'required',
                'city' => 'required',
            ];
            $custommessage=[
                'email.required'=>'Email is required',
                'email.email'=>'Email valid!',
                'password.required'=>'password is required',
                'phone.required'=>'phone is required',
                'name.required'=>'name is required',
                'city.required'=>'city is required',
            ];
            $this->validate($request,$rules,$custommessage);
            try{
                User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                    'phone'=>$request->phone,
                    'city'=>$request->city,
                    'image'=>'fddfd',
                ]);
                return redirect()->route('login')->with('success_message','registeration success');
            }catch(Exception $e){
                return redirect()->back()->with('error_message','registeration failed');

            }
            $this->validate($request,$rules,$custommessage);
        }
        return view('auth.signup');
    }

    public function userlogin(Request $request){
        if($request->isMethod('post')){
            
            $rules=[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $custommessage=[
                'email.required'=>'Email is required',
                'email.email'=>'Email valid!',
                'password.required'=>'password is required'
            ];
            $this->validate($request,$rules,$custommessage);
            if(Auth::guard('web')->attempt(['email'=>$request->email ,'password'=>$request->password])){
            
                Session::regenerateToken();
                return redirect()->intended(RouteServiceProvider::STUDENT);
            }else{
                return redirect()->back()->with('erorr_message','invalid Email or Password');
            }
        }
    }

    public function logoutuser(){
        Auth::guard('web')->logout();

        Session::invalidate();

       Session::regenerateToken();

        return redirect('/login');
    }

}
