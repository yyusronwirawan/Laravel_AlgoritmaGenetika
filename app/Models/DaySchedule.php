<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaySchedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "day_schedules";
    protected $guarded = [];
}
