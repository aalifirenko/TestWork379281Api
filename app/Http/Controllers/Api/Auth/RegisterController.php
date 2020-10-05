<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterController extends Controller
{
    /*
    * Register user
    *
    * @param RegisterRequest $request
    * @return JsonResource
    */
    public function __invoke(RegisterRequest $request)
    {
        # Find User
        $user = User::where('email', $request->get('email'))->first();

        # Check
        if (!$user) {
            #Create User
            $new_user = new User();
            $new_user->fill([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'api_token' => Str::random(60),
                'role_id' => $request->input('role_id', 1),
            ]);
            $new_user->save();

            return JsonResource::make([
                'user' => UserResource::make($new_user),
            ]);
        } else {
            $response = new JsonResponse([
                'message' => 'User already registered',
            ], 401);
            return $response;
        }
    }
}
