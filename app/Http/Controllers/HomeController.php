<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function main()
    {
        return view('admin.layout.main');
    }

        public function index()
        {
            if(Auth::id())
            {
                $usertype=Auth()->user()->usertype;

                if($usertype=='Staff')
                {
                    $leave_count = Leave::where('user_id',Auth()->user()->id)->count();
                    $leave = Leave::orderby('id', 'desc')->where('user_id',Auth()->user()->id)->get();
                    return view('admin.dashboard.admindashboard',compact('leave_count','leave'));
            }
            else if($usertype=='Admin')
            {
                $staff = User::where('usertype','Staff')->count();
                $department_count = Department::count();
                $leave_count = Leave::count();
                // $leave = Leave::orderby('id', 'desc')->get();
                // $department = Department::orderby('id', 'desc')->get();
                $users = User::orderby('id','desc')->where('usertype','Staff')->get();
                foreach ($users as $user) {
                    $user->load('leave');
                }
                return view('admin.dashboard.admindashboard',compact('staff','users','leave_count','department_count'));
            }
            else{
                return redirect()->back();
            }
        }
    }
}
