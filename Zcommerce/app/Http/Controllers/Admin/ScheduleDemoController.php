<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ScheduleDemo;

class ScheduleDemoController extends Controller
{
    public function demoSchedule()
    {
    	$demo_requests = ScheduleDemo::orderBy('id','desc')->get();
    	return view('admin.demo.demo_request', compact('demo_requests'));
    }
}
