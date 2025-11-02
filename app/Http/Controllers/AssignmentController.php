<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::query()->with('volunteer', 'workLocation', 'task')->paginate(10);

        $json = [
            "status" => [
                'status' => true,
                'message' => '',
                'http_code'=> 200
            ],
            "data" => ($assignments->isNotEmpty()) ? $assignments : null
        ];

        return response()->json($json);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'volunteer_id' => 'required|exists:volunteers,id',
            'task_id' => 'required|exists:tasks,id',
            'work_location_id' => 'required|exists:work_locations,id',
        ]);

        $assignment = Assignment::create($validated);

        if($assignment){
            return response()->json([
                "status" => [
                    'status' => true,
                    'message' => 'Added Successfully',
                    'http_code'=> 201
                ],
                "data" => $assignment
            ], 201); 
        }else{
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
        $assignment = Assignment::query()->with('volunteer', 'workLocation', 'task')->find($id);

        if ($assignment) {
            return response()->json([
                "status" => [
                    'status' => true,
                    'message' => 'Success',
                    'http_code'=> 200
                ],
                "data" => $assignment
            ]);
        } else {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Assignment not found',
                    'http_code'=> 404
                ],
                "data" => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::find($id);
        if (!$assignment) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Assignment not found',
                    'http_code'=> 404
                ],
                "data" => null
            ], 404); 
        }

        $validated = $request->validate([
            'volunteer_id' => 'required|exists:volunteers,id',
            'task_id' => 'required|exists:tasks,id',
            'work_location_id' => 'required|exists:work_locations,id',
        ]);

        $result = $assignment->update($validated);

        $status = ($result) ? true : false;

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
       $assignment = Assignment::query()->where('id', $id)->first();

        if (!$assignment) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Assignment not found',
                    'http_code'=> 404
                ],
                "data" => null
            ], 404);
        }

        $result = $assignment->delete();

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
