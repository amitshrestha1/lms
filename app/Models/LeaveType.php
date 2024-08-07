<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    public function userLeaveBalances()
    {
        return $this->hasMany(UserLeaveBalance::class);
    }
    public function Leave(){

        return $this->belongsTo(LeaveType::class);
    }
}
