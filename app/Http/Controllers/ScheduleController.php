<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $schedules = Schedule::all();
            return $this->sendResponse($schedules, 'Schedules retrieved successfully.', 200);
        } catch (\Exception $e) {
            return $this->sendError('Failed to retrieve schedules.', $e->getMessage(), 500);
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
            'course_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $schedule = Schedule::create([
            'course_id' => $input['course_id'],
            'day' => $input['day'],
            'start_time' => $input['start_time'],
            'end_time' => $input['end_time'],
            'room' => $input['room'],
        ]);

        return $this->sendResponse($schedule, 'Schedule created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schedule = Schedule::find($id);

        if (is_null($schedule)) {
            return $this->sendError('Schedule not found.');
        }

        return $this->sendResponse($schedule, 'Schedule retrieved successfully.', 200);
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
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $schedule = Schedule::find($id);
        $schedule->day = $input['day'];
        $schedule->start_time = $input['start_time'];
        $schedule->end_time = $input['end_time'];
        $schedule->room = $input['room'];
        $schedule->save();

        return $this->sendResponse($schedule, 'Schedule updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::find($id);

        if (is_null($schedule)) {
            return $this->sendError('Schedule not found.', [], 404);
        }
        
        $schedule->delete();

        return $this->sendResponse([], 'Schedule deleted successfully.', 200);
    }
}
