<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\LeaveCount;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $department = Department::orderby('id', 'desc')->get();

        return view('admin.user.admincreateuser', compact('department'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|unique:users',
                'password' => 'required|min:8|max:24|confirmed',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'name'=>'required|unique:users',
                'department_id'=>'required',

            ]
        );
        if ($validator->fails()) {
            return redirect(route('user.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = request('password');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path().'/images/profile_picture/';
            $filename = date('Ymdhis').'-'.$file->getClientOriginalName();
            $file->move($path,$filename);
            $user->image = $filename;
        }
        $user->department_id = request('department_id');
        $user->save();
        return redirect(route('user.list'))->with('success', 'User Created Successfully');
    }


    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $department = Department::orderby('id', 'desc')->get();
        return view('admin.user.edituser', compact('user', 'department'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                // 'password' => 'confirmed',  

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if($request->hasFile('image')){
            if(isset($user->image)){
                $old_path = public_path().'/images/profile_picture/' . $user->image;
                if(File::exists($old_path)){
                    File::delete($old_path);
                }
            }
            $file = $request->file('image');
            $path = public_path().'/images/profile_picture/';
            $filename = date('Ymdhis').'-'.$file->getClientOriginalName();
            $file->move($path,$filename);
            $user->image = $filename;
        }
        
        $user->department_id = $request->department_id;
        $user->save();
        return redirect(route('user.list'))->with('success', 'User Updated Successfully');
    }
    public function userlist()
    {
        $user = User::orderby('id', 'desc')->where('usertype', 'Staff')->get();

        return view('admin.user.userlist', compact('user'));
    }
    public function delete($id)
    {
        User::where('id', $id)->with('leaveBalances')->with('leave')->with('leaveType')->with('department')->delete();
        return redirect(route('user.list'))->with('success','User Deleted Successfully');
    }
}
