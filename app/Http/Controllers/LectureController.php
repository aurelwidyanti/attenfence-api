<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LectureController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $lectures = Lecture::all();
            return $this->sendResponse(LectureResource::collection($lectures), 'Lectures retrieved successfully.', 200);
        } catch (\Exception $e) {
            return $this->sendError('Failed to retrieve lectures.', $e->getMessage(), 500);
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
            'nidn' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $hashedPassword = bcrypt($input['password']);

        $lecture = Lecture::create([
            'nidn' => $input['nidn'],
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $hashedPassword,
        ]);

        return $this->sendResponse(new LectureResource($lecture), 'Lecture created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lecture = Lecture::find($id);

        if (is_null($lecture)) {
            return $this->sendError('Lecture not found.', [], 404);
        }

        return $this->sendResponse(new LectureResource($lecture), 'Lecture retrieved successfully.', 200);
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
        $lecture = Lecture::find($id);
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        if (isset($input['password'])) {
            $hashedPassword = bcrypt($input['password']);
            $lecture->password = $hashedPassword;
        }

        $lecture->name = $input['name'];
        $lecture->email = $input['email'];
        $lecture->save();

        return $this->sendResponse(new LectureResource($lecture), 'Lecture updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lecture = Lecture::find($id);

        if (is_null($lecture)) {
            return $this->sendError('Lecture not found.', [], 404);
        }

        $lecture->delete();

        return $this->sendResponse([], 'Lecture deleted successfully.', 200);
    }
}
