<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /*
    * Profile user
    *
    * @param Request $request
    * @return JsonResource
    */
    public function __invoke(Request $request, $api_user): JsonResource
    {
        return JsonResource::make([
            'user' => UserResource::make($api_user),
        ]);
    }
}
