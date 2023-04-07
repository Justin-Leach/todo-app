<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function taskView()
    {
        return view("tasks.task");
    }
}
