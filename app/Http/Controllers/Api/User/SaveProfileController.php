<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\SaveProfileRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;

class SaveProfileController extends Controller
{

    /*
    * Save Profile user
    *
    * @param Request $request
    * @return JsonResource
    */
    public function __invoke(SaveProfileRequest $request, $api_user): JsonResource
    {
        $api_user->name = $request->get('name');
        if ($request->get('email')) {
            $api_user->email = $request->get('email');
        }
        $api_user->save();

        return JsonResource::make([
            'user' => UserResource::make($api_user),
        ]);
    }
}
