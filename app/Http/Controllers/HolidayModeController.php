<?php

namespace App\Http\Controllers;

use App\Models\HolidayMode;
use App\Models\SelectedMode;
use Illuminate\Http\Request;

class HolidayModeController extends Controller
{
    public function index(){
        return view('admin.holidaymode.createholidaymode');
    }

    public function create(Request $request){
        $holidaymode = new HolidayMode();
        $holidaymode->mode = $request->mode;
       
        $holidaymode->save();
        return redirect(route('select.mode'))->with('success','Created Successfully');
    }

    public function select(){
        $holidaymode = HolidayMode::all();
        $a = SelectedMode::all();
        return view('admin.holidaymode.selectholiday',compact('holidaymode','a'));
    }

    public function selector(Request $request){
        // dd($request->all());
        $selectedholidaymode = $request->input('selectedbox',[]);
        // dd($selectedholidaymode);
        SelectedMode::truncate();
        foreach($selectedholidaymode as $a){
            SelectedMode::create([
                'mode_id'=>$a,
                'status'=> true,
            ]);
        }
        return redirect()->route('select.mode');
    }
}
