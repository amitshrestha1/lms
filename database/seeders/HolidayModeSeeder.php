<?php

namespace Database\Seeders;

use App\Models\HolidayMode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidayModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $holiday_modes= [
        [
            'mode'=>'SUNDAY',
            
        ],
        [
            'mode'=>'MONDAY',
            
        ],
        [
            'mode'=>'TUESDAY',
            
        ],
        [
            'mode'=>'WEDNESDAY',
            
        ],
        [
            'mode'=>'THURSDAY',

        ],
        [
            'mode'=>'FRIDAY',
            
        ],
        [
            'mode'=>'SATURDAY',
            
        ],
    ];
      foreach ($holiday_modes as $key => $holiday) {
        HolidayMode::create($holiday);
      }
        
    }
}
