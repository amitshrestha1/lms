<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class HolidayController extends Controller
{
    public function index(){
        return view('admin.holiday.createholiday');
    }

    public function create(Request $request){
        $holiday = new Holiday();
        $holiday->name = $request->name;
        $holiday->date = $request->date;
        $holiday->save();
        return redirect(route('list.holiday'))->with('success','Created Successfully');
    }

    public function list(){
        $holiday = Holiday::all();
        return view('admin.holiday.listholiday',compact('holiday'));
    }

    public function edit($id){
        $holiday = Holiday::where('id',$id)->first();
        return view('admin.holiday.editholiday',compact('holiday'));
    }

    public function update(Request $request){
        $holiday = Holiday::find($request->id);
        $holiday->name = $request->name;
        $holiday->date = $request->date;
        $holiday->save();
        return redirect(route('list.holiday'))->with('success','Updated Successfully');
    }

    public function delete($id){
        $holiday = Holiday::where('id',$id)->delete();
        return redirect(route('list.holiday'))->with('success','Deleted Successfully');
    }
   
}
