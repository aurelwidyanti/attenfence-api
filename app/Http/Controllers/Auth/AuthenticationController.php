<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        try {
            if (Auth::attempt(['nim' => request("nim"), 'password' => request("password")])) {
                $user = Auth::user();
                /** @var \App\Models\User $user **/
                $success['token'] =  $user->createToken('Attenfence')->plainTextToken;
                $success['name'] =  $user->name;
                $success['nim'] =  $user->nim;
                $success['email'] =  $user->email;
                
                return $this->sendResponse($success, 'User login successfully.', 200);
            } else {
                return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
            }
        } catch (\Exception $e) {
            return $this->sendError('An error occurred.', ['error' => $e->getMessage()]);
        }
    }
}
