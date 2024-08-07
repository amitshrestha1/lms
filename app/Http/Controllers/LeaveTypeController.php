<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController extends Controller
{
    public function index(){
        return view('admin.leave.createleavetype');
    }

    public function create(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'name'=> 'required|unique:leave_types',
                // 'password' => 'confirmed',  

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $leavetype = new LeaveType();
        $leavetype->name=$request->name;
        $leavetype->days=$request->days;
        $leavetype->save();
        return redirect(route('leavetype.list'))->with('success','Leave Type Ceated Successfully');
    }

    public function list(){
        $leavetype = LeaveType::orderby('id','desc')->get();
        return view('admin.leave.viewleavetype',compact('leavetype'));
    }

    public function delete($id){
        LeaveType::where('id',$id)->delete();
        notify()->success("Deleted Successfully");
        return redirect(route('leavetype.list'))->with('success','Leave Type Deleted Successfully');
    }
}
