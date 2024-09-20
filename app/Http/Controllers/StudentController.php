<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function dashboard(){
        return view('student.dashboard');
    }
    public function updatedetails(Request $request){
        if($request->isMethod('post')){
            
            $rules=[
                'email' => 'required|email|max:255',
                'name'=> 'required|max:200',
                'phone'=> 'required|numeric|digits:11',
                'image'=> 'mimes:jpeg,jpg,png,gif|max:1000',
                
            ];
            $custommessage=[
                'email.required'=>'Email is required',
                'email.email'=>'Email valid!',
                'name.required'=>'Name is required',
                'name.ragex'=>'Name valid!',
                'mobile.required'=>'mobile is required',
                'mobile.numeric'=>' Valid mobile is required',
                'mobile.digits'=>'mobile is required 11 Numbers only',
                
           



            ];
            $this->validate($request,$rules,$custommessage);
            if($request->hasFile('image')){
                $destination='/admin/photos';
                $image=$request->file('image');
                $image_name=$image->getClientOriginalName();

                
                $path=$request->file('image')->storeAs($destination,$image_name,'public');
                
               
            }  else{
                $path = $request->input('currentadminimage');
            }                     
            User::where('id',Auth::guard('web')->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'image'=>$path,

            ]);
            return redirect()->back()->with('success_message','informaion has been updated successfully');
        }
        return view('student.profile.updatedetails');
    }

    public function updatepassword(Request $request){
        if($request->isMethod('post')){
            if(Hash::check($request->currentpassword,Auth::guard('web')->user()->password)){
                if($request->newpassword==$request->confirmpassword){
                    User::where('email',Auth::guard('web')->user()->email)->update([
                        'password'=>bcrypt($request->newpassword)
                    ]);
                    return redirect()->back()->with('success_message',' Password has been updated successfully');


                }else{
                    return redirect()->back()->with('erorr_message','New Password Not Match Confirm Password ');

                }

            }else{
                return redirect()->back()->with('erorr_message','current password is incorrect!');
            }
        }

        return view('student.profile.updatepassword');
    }

    public function checkcurrentpassword(Request $request){
        $data=$request->all();
        if(Hash::check($data['currentpassword'],Auth::guard('web')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }
}
