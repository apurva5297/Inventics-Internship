<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleDemo extends Model
{
    protected $table = 'schedule_demos';

    protected $fillable = ['name','company_name','email','phone','schedule_date'];
}
