<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Validator;

class SaveAvatarController extends Controller
{

    /*
    * Save avatar user
    *
    * @param Request $request
    * @return JsonResource
    */
    public function __invoke(Request $request, $api_user)
    {
        $file = $request->file('image');

        $validator = Validator::make(['image' => $file], ['image' => 'required|mimes:jpeg,bmp,png']);

        if ($validator->passes()) {

            $directory = 'images/avatars/';
            $directoryPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory;
            $filename = '';
            do {
                $filename = uniqid() . '.png';
            } while(file_exists($directoryPath . $filename));

            $file->move($directoryPath, $filename);

            $api_user->avatar = $filename;
            $api_user->save();

            return JsonResource::make([
                'user' => UserResource::make($api_user),
            ]);

        } else {
            $response = new JsonResponse([
                'message' => 'User already registered',
            ], 401);
            return $response;
        }
    }
}
