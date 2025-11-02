<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\Assignment;
use App\Models\WorkLocation;

class VolunteerController extends Controller
{
    
    public function index()
    {
        $volunteers = Volunteer::query()->with(['assignments', 'assignments.workLocation', 'assignments.task'])->paginate(10);

        $volunteers->getCollection()->transform(function ($volunteer) {
            $latestAssignment = $volunteer->assignments->sortByDesc('created_at')->first();
            $volunteer->work_location = $latestAssignment?->workLocation?->name ?? '—';
            return $volunteer;
        });

        $json = [
            "status" => [
                'status' => true,
                'message' => '',
                'http_code'=> 200
            ],
            "data" => ($volunteers->isNotEmpty()) ? $volunteers : null
        ];

        return response()->json($json);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'phone' => 'nullable|string|max:20',
            'skills' => 'nullable|string',

            'assignments' => 'required|array|min:1',
            'assignments.*.task_id' => 'required|exists:tasks,id',
            'assignments.*.work_location_id' => 'required|exists:work_locations,id',
        ]);

        $volunteer = Volunteer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'skills' => $validated['skills'] ?? null,
        ]);

        if ($volunteer) {
            foreach ($validated['assignments'] as $assignment) {
                Assignment::create([
                    'volunteer_id' => $volunteer->id,
                    'task_id' => $assignment['task_id'],
                    'work_location_id' => $assignment['work_location_id'],
                ]);
            }

            $status = true;
        } else {
            $status = false;
        }

        return response()->json([
            "status" => [
                'status' => $status,
                'message' => $status ? 'Added Successfully' : 'Failed',
                'http_code'=> $status ? 201 : 502,
            ],
            "data" => $volunteer,
        ]);
    }

    public function show($id)
    {
        $volunteer = Volunteer::query()->with(['assignments', 'assignments.task', 'assignments.workLocation'])->find($id);
        $status = false;

        if($volunteer){
            $status = true;
        }

        $json = [
            "status" => [
                'status' => $status,
                'message' => $status ? 'Success' : 'Failed',
                'http_code'=> ($status) ? 200 : 502
            ],
            "data" => $volunteer
        ];

        return response()->json($json);
    }

    public function update(Request $request, $id)
    {
        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return response()->json(['message' => 'Volunteer not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'skills' => 'nullable|string',

            'assignments' => 'nullable|array',
            'assignments.*.task_id' => 'nullable|exists:tasks,id',
            'assignments.*.work_location_id' => 'nullable|exists:work_locations,id',
        ]);

        $volunteer->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'skills' => $validated['skills'] ?? null,
        ]);

        if (isset($validated['assignments'])) {
            $volunteer->assignments()->delete();

            foreach ($validated['assignments'] as $assignment) {
                $volunteer->assignments()->create([
                    'task_id' => $assignment['task_id'] ?? null,
                    'work_location_id' => $assignment['work_location_id'] ?? null,
                ]);
            }
        }

        $json = [
            "status" => [
                'status' => true,
                'message' => 'Updated Successfully',
                'http_code' => 200
            ],
            "data" => [
                'name' => $volunteer->name,
                'email' => $volunteer->email,
                'phone' => $volunteer->phone,
                'skills' => $volunteer->skills,
                'assignments' => $volunteer->assignments()->with(['task', 'workLocation'])->get()->map(function ($assignment) {
                    return [
                        'task' => $assignment->task?->name,
                        'work_location' => $assignment->workLocation?->name,
                    ];
                }),
            ]
        ];

        return response()->json($json);
    }

    public function destroy($id)
    {
        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return response()->json([
                "status" => [
                    'status' => false,
                    'message' => 'Volunteer not found',
                    'http_code'=> 404
                ],
                "data" => null
            ]);
        }

        $volunteer->assignments()->delete();

        $result = $volunteer->delete();

        return response()->json([
            "status" => [
                'status' => $result,
                'message' => $result ? 'Deleted Successfully' : 'Failed',
                'http_code'=> $result ? 200 : 502,
            ],
            "data" => null
        ]);
    }
}
