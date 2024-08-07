<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(){
        return view('admin.department.admincreatedepartment');
    }
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'=> 'required|unique:departments',
                // 'password' => 'confirmed',  

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $department = new Department();
        $department->name = $request->name;
        $department->save();
        
        return redirect(route('department.list'))->with('success','Department Created Successfully');
    }
    public function edit($id){
        $department= Department::where('id',$id)->first();
        
        return view('admin.department.editdepartment',compact('department'));
    }

    public function update(Request $request)
    {
        $department = Department::find($request->id);
        $department->name = $request->name;   
        $department->save();
        return redirect(route('department.list'))->with('success','Department Updated Successfully');
    }

    public function departmentlist(){
        $department = Department::orderby('id','desc')->get();
        return view('admin.department.departmentlist',compact('department'));
    }
    public function delete($id){
        Department::where('id',$id)->delete();
        return redirect(route('department.list'))->with('success','Department Deleted Successfully');
    }
}
