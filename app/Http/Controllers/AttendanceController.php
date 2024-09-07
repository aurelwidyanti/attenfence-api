<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       try {
            $attendances = Attendance::all();
            return $this->sendResponse($attendances, 'Attendance data retrieved successfully.', 200);
       } catch (\Exception $e) {
            return $this->sendError('Failed to fetch attendance data', $e->getMessage(), 500);            
       } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'schedule_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $attendance = Attendance::create([
            'schedule_id' => $input['schedule_id'],
            'user_id' => $input['user_id'],
            'status' => $input['status'],
        ]);

        return $this->sendResponse($attendance, 'Attendance data created successfully.', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::find($id);

        if (is_null($attendance)) {
            return $this->sendError('Attendance data not found.', 404);
        }

        return $this->sendResponse($attendance, 'Attendance data retrieved successfully.', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $attendance = Attendance::find($id);
        if (is_null($attendance)) {
            return $this->sendError('Attendance data not found.', 404);
        }

        $attendance->status = $input['status'];
        $attendance->save();

        return $this->sendResponse($attendance, 'Attendance data updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::find($id);

        if (is_null($attendance)) {
            return $this->sendError('Attendance data not found.', 404);
        }

        $attendance->delete();

        return $this->sendResponse([], 'Attendance data deleted successfully.', 200);
    }
}
