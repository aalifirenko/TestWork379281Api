<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /*
    * Login user
    *
    * @param LoginRequest $request
    * @return JsonResource
    */
    public function __invoke(LoginRequest $request)
    {
        # Find Auth
        $user = User::where('email', $request->get('email'))->first();

        # Check
        if ($user && Hash::check($request->get('password'), $user->password)) {
            return JsonResource::make([
                'user' => UserResource::make($user),
            ]);
        } else {
            $response = new JsonResponse([
                'message' => 'User not found',
            ], 401);
            return $response;
        }
    }
}
