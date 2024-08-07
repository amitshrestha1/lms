<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;
use Google\Service\ServiceControl\Auth;

class CalendarController extends Controller
{
    public function index(){
        $events = array();
        $holidayEvents = array();
        $user1 = array();
        $leaveData = Leave::all();
        $holidayData = Holiday::all();
        $userData = User::where('id',Auth()->user()->id)->get();   
        foreach ($leaveData as $data) {
            $events[]=[
                'reason'=>$data->reason,
                'from'=>$data->from,
                'to'=>$data->to,
                'name'=>$data->user->name,
                'user_id'=>$data->user_id,
                'leave_type'=>$data->type->name,
                'status'=>$data->status,
            ];
            
        }
        foreach ($holidayData as $data){
            $holidayEvents[]=[
                'name'=>$data->name,
                'date'=>$data->date,
            ];
        }
        foreach ($userData as $data){
            $user1[]=[
               'usertype'=>$data->usertype,
               'id'=>$data->id,
            ];
        }

        return view('calendar.calendar', [
            'events' => $events,
            'holidayEvents' => $holidayEvents,
            'user1' => $user1,
        ]);
    }
}
