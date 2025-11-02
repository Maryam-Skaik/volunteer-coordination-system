<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkLocation;

class WorkLocationController extends Controller
{
    public function index()
    {
        $workLocations = WorkLocation::query()->paginate(10);

        return response()->json([
            "status" => [
                'status' => true,
                'message' => '',
                'http_code' => 200
            ],
            "data" => $workLocations->isNotEmpty() ? $workLocations : null
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'description' => 'nullable|string',
        ]);

        $workLocation = WorkLocation::create($validated);

        if ($workLocation) {
            return response()->json([
                "status" => [
                    'status' => true,
                    'message' => 'Added Successfully',
                    'http_code' => 201
                ],
                "data" => $workLocation
            ], 201);
        }

        return response()->json([
            "status" => [
                'status' => false,
                'message' => 'Failed',
                'http_code' => 500
            ],
            "data" => null
        ], 500);
    }

    public function show($id)
    {
        $workLocation = WorkLocation::query()->with(['assignments.task', 'assignments.workLocation'])->find($id);

        if (!$workLocation) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Work Location Not Found',
                    'http_code' => 404
                ],
                "data" => null
            ], 404);
        }

        return response()->json([
            "status" => [
                'status' => true,
                'message' => 'Success',
                'http_code' => 200
            ],
            "data" => $workLocation
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $workLocation = WorkLocation::query()->find($id);

        if (!$workLocation) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Work Location Not Found',
                    'http_code' => 404
                ],
                "data" => null
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'description' => 'nullable|string',
        ]);

        $result = $workLocation->update($validated);

        return response()->json([
            "status" => [
                'status' => $result,
                'message' => $result ? 'Updated Successfully' : 'Failed',
                'http_code' => $result ? 200 : 500
            ],
            "data" => null
        ], $result ? 200 : 500);
    }

    public function destroy($id)
    {
        $workLocation = WorkLocation::find($id);

        if (!$workLocation) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Work Location Not Found',
                    'http_code' => 404
                ],
                "data" => null
            ], 404);
        }

        $workLocation->tasks()->delete();
        $workLocation->assignments()->delete();
        $result = $workLocation->delete();

        return response()->json([
            "status" => [
                'status' => $result,
                'message' => $result ? 'Deleted Successfully' : 'Failed',
                'http_code' => $result ? 200 : 500
            ],
            "data" => null
        ], $result ? 200 : 500);
    }
}