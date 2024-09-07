<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        try {
            $users = User::all();
            return $this->sendResponse(UserResource::collection($users), 'Users retrieved successfully.', 200);
        } catch (\Exception $e) {
            return $this->sendError('Error retrieving users.', $e->getMessage(), 500);
        }
    }
}
