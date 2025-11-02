<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\WorkLocation;
use App\Models\Task;
use App\Models\Assignment;

class DashboardController extends Controller
{
    public function summary()
    {
        return response()->json([
            'status' => ['status' => true, 'message' => '', 'http_code' => 200],
            'data' => [
                'volunteers_count' => Volunteer::count(),
                'locations_count' => WorkLocation::count(),
                'tasks_count' => Task::count(),
                'assignments_count' => Assignment::count(),
                'latest_volunteers' => Volunteer::latest()->take(5)->get(['id', 'name', 'email', 'created_at']),
            ]
        ]);
    }
}
