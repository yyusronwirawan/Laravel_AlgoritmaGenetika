<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSchedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "time_schedules";
    protected $guarded = [];
}
