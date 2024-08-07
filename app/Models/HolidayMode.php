<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayMode extends Model
{
    use HasFactory;
    public function selected()
    {
        return $this->hasMany(SelectedMode::class,'mode_id');
    }
}
