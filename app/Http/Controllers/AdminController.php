<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function admins(){
        $admins=Admin::get();
        return view('admin.admins.index',compact('admins'));
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
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'image'=>$path,

            ]);
            return redirect()->back()->with('success_message','informaion has been updated successfully');
        }
        return view('admin.profile.updatedetails');
    }

    public function updatepassword(Request $request){
        if($request->isMethod('post')){
            if(Hash::check($request->currentpassword,Auth::guard('admin')->user()->password)){
                if($request->newpassword==$request->confirmpassword){
                    Admin::where('email',Auth::guard('admin')->user()->email)->update([
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

        return view('admin.profile.updatepassword');
    }

    public function checkcurrentpassword(Request $request){
        $data=$request->all();
        if(Hash::check($data['currentpassword'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    public function addedit(Request $request,$id=null){
        if($id==null){
            $title='Add admin';
            $subadmindata=new Admin;
            $message='Admin Added Successfully';
        }else{
            $title='Edit admin';
            $subadmindata=Admin::find($id);
            $message='Admin Updated Successfully'; 
        }
        if($request->isMethod('post')){
            if($id==""){
                $subadminemail=Admin::where('email',$request->email)->count();
                if($subadminemail > 0){
                    return redirect()->back()->with('error_message','subadmin email exists!');

                }
            }
            $rules=[
                'name'=>'required',
                'phone'=>'required|numeric',
                'image'=> 'mimes:jpeg,jpg,png,gif|max:1000',
            ];
            $custommessage=[
                'name.required'=>'name is required',
                'phone.required'=>'mobile is required',
                'mobile.numeric'=>' valid mobile is required',
                'image.image'=>'Valid Image is required'
            ];
            $this->validate($request,$rules,$custommessage);

            if($request->hasFile('image')){
                $destination='/admin/photos';
                $image=$request->file('image');
                $image_name=$image->getClientOriginalName();

                
                $path=$request->file('image')->storeAs($destination,$image_name,'public');
                
               
            }else if(!empty($request->input('currentadminimage'))){
                $path = $request->input('currentadminimage');
            }else{
                $path = "";
            } 
            $subadmindata->name=$request->name;
            $subadmindata->city=$request->city;
            $subadmindata->phone=$request->phone;
            $subadmindata->image=$path;
            
            if($id==""){
                $subadmindata->email=$request->email;
                $subadmindata->type= "subadmin";
            }
            if($request->password != null){
                $subadmindata->password=bcrypt($request->password);
            }
            $subadmindata->save();
            return redirect('admin/admins')->with('success_message',$message);
        }

        return view('admin.admins.add-edit',compact('title','subadmindata'));
    }

    public function deleteadmin($id){
        $this->deleteimage($id);
        Admin::destroy($id);
        return redirect('admin/admins')->with('success_message','Admin Deleted Sussessfully');
    }


    public function deleteimage($id){
        $adminimage=Admin::select('image')->where('id',$id)->first();
            // تحويل النص ال JSON إلى كائن PHP
        
        $jsonObject = json_decode($adminimage, true);

        // الحصول على قيمة المسار
        $AdminImage = $jsonObject['image'];

        // إضافة كلمة "public" إلى المسار
        $fullPath = 'public/' . $AdminImage; 
         
        if(Storage::exists($fullPath)){
            
            Storage::delete($fullPath);
            
        }
        Admin::where('id',$id)->update(['image'=>""]);
        return redirect()->back()->with('success_message','admin Image deleted successfully');

    }

    public function showstudents(){
        $users=User::get();
        return view('admin.admins.showusers',compact('users'));
    }

    public function deleteuser($id){
      
        User::destroy($id);
        return redirect('admin/students')->with('success_message','User Deleted Sussessfully');
    }
}
