<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\LeaveCount;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\LeaveCountController;
use App\Models\Holiday;
use App\Models\SelectedMode;
use App\Models\User;
use App\Models\UserLeaveBalance;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendLeaveApplyEmail;
use App\Notifications\SendLeaveAnswers;
use App\Events\PostPublished;

class LeaveController extends Controller
{
    public function index()
    {
        $leavetypes = LeaveType::orderby('id', 'desc')->get();


        $user = User::orderby('id', 'desc')->where('usertype', 'Staff')->get();
        $userId = auth()->user()->id;

        $userLeaveBalances = UserLeaveBalance::where('user_id', $userId)->get();
        $remainingDays = [];
        foreach ($leavetypes as $leavetype) {
            $balance = $userLeaveBalances->where('leave_type_id', $leavetype->id)->first();


            if ($balance) {
                $remainingDays[$leavetype->id] = $balance->remaining_days;
            } else {
                // Set default remaining days if user has no balance for this leave type
                $remainingDays[$leavetype->id] = $leavetype->days;
            }
        }
        // dd($leavetypes);



        // Return JSON response
        if (request()->ajax()) {
            return response()->json(['leavetypes' => $leavetypes, 'remainingDays' => $remainingDays]);
        }
        $leavetype = LeaveType::orderby('id', 'desc')->get();

        // If it's a regular request, return the view
        return view('admin.leave.applyleave', compact('leavetype', 'user', 'remainingDays'));
    }
    public function ajaxHandler(Request $request, $id)
    {
        if ($request->ajax()) {


            $leavetypes = LeaveType::orderBy('id', 'desc')->get();
            $userLeaveBalances = UserLeaveBalance::where('user_id', $id)->get();
            $remainingDays = [];

            foreach ($leavetypes as $leavetype) {
                $balance = $userLeaveBalances->where('leave_type_id', $leavetype->id)->first();

                if ($balance) {
                    $remainingDays[$leavetype->id] = $balance->remaining_days;
                } else {
                    // Set default remaining days if the user has no balance for this leave type
                    $remainingDays[$leavetype->id] = $leavetype->days;
                }
            }

            $response = [
                'status' => 'success',
                'message' => 'Data received successfully',
                'leavetypes' => $leavetypes,
                'remainingDays' => $remainingDays
            ];

            return response()->json($response);
        }

        // If it's a regular request, return the view
        $leavetype = LeaveType::orderBy('id', 'desc')->get();
        return view('admin.leave.applyleave', compact('leavetype', 'user', 'remainingDays'));
    }

    public function apply(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'from' => 'required|date|after:yesterday',
                'to' => 'required|date|after_or_equal:from',
                'type_id' => 'required'

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $weekleavecheck = Leave::where('user_id', $request->user_id)
            ->where(function ($query) use ($request) {
                $query->where('from', '<=', $request->to)
                    ->where('to', '>=', $request->from);
            })
            ->exists();

        if ($weekleavecheck) {
            return redirect()->back()->with('error', 'You have already applied for leave this week.');
        }
        $leave = new Leave();
        $leave->type_id = $request->type_id;
        $leave->reason = $request->reason;
        $leave->from = $request->from;
        $leave->to = $request->to;
        $leave->user_id = $request->user_id;
        $leave->save();


        $userLeaveBalance = UserLeaveBalance::where('leave_type_id', $leave->type_id)->where('user_id', $leave->user_id)->first();
        if (!$userLeaveBalance) {
            $userLeaveBalance = new UserLeaveBalance();
        }
        $userLeaveBalance->user_id = Auth()->user()->id;
        $userLeaveBalance->leave_type_id = $leave->type_id;
        $userLeaveBalance->remaining_days = $leave->type->days;
        $userLeaveBalance->save();
        $admin = User::where('Usertype', 'Admin')->get();
        $details = [
            'Greeting' => 'Hi Admin',
            'Intro' => 'A staff in your company has applied for a leave.',
            'User' => 'Username:' . $leave->user->name,
            'Leave Type' => 'Leave Type:' . $leave->type->name,
            'Reason' => 'Reason:' . $request->reason,
            'From' => 'From:' . $request->from,
            'To' => 'To:' . $request->to,
        ];
        Notification::send($admin, new SendLeaveApplyEmail($details));
        return redirect(route('leave.list'))->with('success', 'Leave Applied Successfully');
    }
    public function applyasadmin(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'from' => 'required|date|after:yesterday',
                'to' => 'required|date|after_or_equal:from',
                'type_id' => 'required'

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $weekleavecheck = Leave::where('user_id', $request->user_id)
            ->whereBetween('from', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->exists();
        dd($weekleavecheck);
        if ($weekleavecheck) {
            return redirect()->back()->with('error', 'You have already applied for leave this week.');
        }
        $leave = new Leave();
        $leave->type_id = $request->type_id;
        $leave->reason = $request->reason;
        $leave->from = $request->from;
        $leave->to = $request->to;
        $leave->user_id = $request->user_id;
        $leave->save();


        $userLeaveBalance = UserLeaveBalance::where('leave_type_id', $leave->type_id)->where('user_id', $leave->user_id)->first();
        if (!$userLeaveBalance) {
            $userLeaveBalance = new UserLeaveBalance();
        }
        $userLeaveBalance->user_id = $leave->user_id;
        $userLeaveBalance->leave_type_id = $leave->type_id;
        $userLeaveBalance->remaining_days = $leave->type->days;
        $userLeaveBalance->save();
        $admin = User::where('Usertype', 'Admin')->get();
        $details = [
            'Greeting' => 'Hi Admin',
            'Intro' => 'A staff in your company has applied for a leave.',
            'User' => 'Username:' . $leave->user->name,
            'Leave Type' => 'Leave Type:' . $leave->type->name,
            'Reason' => 'Reason:' . $request->reason,
            'From' => 'From:' . $request->from,
            'To' => 'To:' . $request->to,
        ];
        Notification::send($admin, new SendLeaveApplyEmail($details));

        return redirect(route('leave.list'))->with('success', 'Leave Applied Successfully');
    }
    public function approve($id)
    {
        $leave = Leave::find($id);


        if ($leave) {

            $startDate = Carbon::parse($leave->from);
            $endDate = Carbon::parse($leave->to);
            $diffindays = $startDate->diffInDays($endDate) + 1;
            $now = Carbon::now();
            // Initialize an empty array to store day names
            $dayNames = [];

            // Iterate through each day in the date range
            while ($startDate->lte($endDate)) {
                // Add the current day's name to the array
                $dayNames[] = $startDate->englishDayOfWeek;

                // Move to the next day
                $startDate->addDay();
            }

            $holidaymode = SelectedMode::where('status', '1')->get();
            $modeNames = $holidaymode->map(function ($selectedMode) {
                return $selectedMode->holidaymode->mode;
            })->toArray();
            $modeNamesLower = array_map('strtolower', $modeNames);
            $dayNamesLower = array_map('strtolower', $dayNames);
            $matchedDays = array_intersect($modeNamesLower, $dayNamesLower);
            $weekholiday = count($matchedDays);


            $holidays = Holiday::where(function ($query) use ($leave) {
                $query->where('date', '>=', $leave->from)
                    ->where('date', '<=', $leave->to);
            })->pluck('date');

            $holidaycount = count($holidays);

            $diff = $diffindays - $holidaycount- $weekholiday;
            $userLeaveBalance = UserLeaveBalance::where('user_id', $leave->user_id)
                ->where('leave_type_id', $leave->type_id)
                ->first();


            if (
                $leave->status !== "Approved" &&
                $leave->status !== "Rejected" &&
                $userLeaveBalance &&
                $userLeaveBalance->remaining_days >= $diff
            ) {
                $leave->status = "Approved";

                // Subtract the approved leave days from the user's leave balance
                $userLeaveBalance->remaining_days = $userLeaveBalance->remaining_days - $diff;
                $userLeaveBalance->save();

                $leave->save();
                $user = User::where('id', $leave->user->id)->get();
                $answers = [
                    'Subject' => 'You Leave Proposal Result',
                    'Greetings' => 'Hi ' . $leave->user->name,
                    'Answer' => 'Your Leave Request Has Been Approved',
                    'Reason' => '',
                    'Thankyou' => 'Thank You,',

                ];
                Notification::send($user, new SendLeaveAnswers($answers));


                return redirect(route('leave.list'))->with('success', 'Approved Successfully');
            } elseif ($leave->status == "Rejected") {
                return redirect(route('leave.list'))->with('error', 'Leave is already rejected.');
            } else {
                return redirect(route('leave.list'))->with('error', 'Remaining Days is less than Leave Days');
            }
        }

        return redirect(route('leave.list'))->with('error', 'Leave not found.');
    }

    public function reject(Request $request)
    {
        $leave = Leave::find($request->id);
        // dd($request->id);

        if ($leave) {
            if ($leave->status !== "Approved" && $leave->status !== "Rejected") {
                $leave->status = "Rejected";
                $leave->save();
                $rejectreason = $request->rejectreason;

                $user = User::where('id', $leave->user->id)->get();
                $answers = [
                    'Subject' => 'You Leave Proposal Result',
                    'Greetings' => 'Hi' . $leave->user->name,
                    'Answer' => 'Your Leave Request Has Been Rejected',
                    'Reason' => 'Reason:' . $rejectreason,
                    'Thankyou' => 'Thank You,',

                ];
                Notification::send($user, new SendLeaveAnswers($answers));

                return redirect(route('leave.list'))->with('success', 'Rejected Successfully');
            } else if ($leave->status == "Rejected") {

                return redirect(route('leave.list'))->with('error', 'Leave is already rejected.');
            } else {
                return redirect(route('leave.list'))->with('error', 'Leave is already approved.');
            }
        }

        return redirect(route('leave.list'))->with('error', 'Leave not found.');
    }

    public function list()
    {

        if (Auth()->user()->usertype == "Admin") {
            $leave = Leave::orderby('id', 'desc')->get();
        } else {
            $leave = Leave::orderby('id', 'desc')->where('user_id', Auth()->user()->id)->get();
        }
        // $leave = Leave::orderby('id','desc')->where('type_id')->get();
        return view('admin.leave.listleave', compact('leave'));
    }



    public function delete($id)
    {
        Leave::where('id', $id)->delete();
        return redirect(route('leave.list'))->with('success', 'Leave Application Deleted Successfully');
    }
}
