<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $courses = Course::all();
            return $this->sendResponse($courses, 'Courses retrieved successfully.', 200);
        } catch (\Exception $e) {
            return $this->sendError('Failed to retrieve courses.', $e->getMessage(), 500);
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
            'code' => 'required',
            'name' => 'required',
            'sks' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $course = Course::create([
            'code' => $input['code'],
            'name' => $input['name'],
            'sks' => $input['sks'],
        ]);

        return $this->sendResponse($course, 'Course created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);

        if (is_null($course)) {
            return $this->sendError('Course not found.');
        }

        return $this->sendResponse($course, 'Course retrieved successfully.', 200);
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
        $course = Course::find($id);
        $validator = Validator::make($input, [
            'code' => 'required',
            'name' => 'required',
            'sks' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $course->code = $input['code'];
        $course->name = $input['name'];
        $course->sks = $input['sks'];
        $course->save();

        return $this->sendResponse($course, 'Course updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);

        if (is_null($course)) {
            return $this->sendError('Course not found.', [], 404);
        }

        $course->delete();

        return $this->sendResponse($course, 'Course deleted successfully.', 200);
    }
}
