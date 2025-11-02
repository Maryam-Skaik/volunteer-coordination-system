<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::query()->with('workLocation')->paginate(10);

        $json = [
            "status" => [
                'status' => true,
                'message' => '',
                'http_code'=> 200
            ],
            "data" => ($tasks->isNotEmpty()) ? $tasks : null
        ];

        return response()->json($json);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'work_location_id' => 'required|integer|exists:work_locations,id',
            'description' => 'nullable|string',
        ]);

        $task = Task::create($validated);

        if ($task) {
            return response()->json([
                "status" => [
                    'status' => true,
                    'message' => 'Added Successfully',
                    'http_code'=> 201
                ],
                "data" => $task
            ], 201); 
        } else {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Failed',
                    'http_code'=> 500 
                ],
                "data" => null
            ], 500);
        }

    }

    public function show($id)
    {
        $task = Task::query()->with('workLocation')->find($id);

        if (!$task) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Task Not Found',
                    'http_code'=> 404
                ],
                "data" => null
            ], 404);
        }

        return response()->json([
            "status" => [
                'status' => true,
                'message' => 'Success',
                'http_code'=> 200
            ],
            "data" => $task
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $task = Task::query()->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404); 
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'work_location_id' => 'required|integer|exists:work_locations,id',
            'description' => 'nullable|string',
        ]);

        $result = $task->update($validated);

        $status = false;

        if($result){
            $status = true;
        }

        $json = [
            "status" => [
                'status' => $status,
                'message' => $status ? 'Updated Successfully' : 'Failed',
                'http_code'=> ($status) ? 200 : 500
            ],
            "data" => null
        ];

        return response()->json($json);
    }

   public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Task Not Found',
                    'http_code'=> 404
                ],
                "data" => null
            ], 404);
        }

        $task->assignments()->delete();
        $result = $task->delete();

        return response()->json([
            "status" => [
                'status' => $result,
                'message' => $result ? 'Deleted Successfully' : 'Failed',
                'http_code'=> $result ? 200 : 500
            ],
            "data" => null
        ], $result ? 200 : 500);
    }

}
