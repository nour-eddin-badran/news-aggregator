<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Dto\UserPreferencesDto;
use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\User\AddPreferencesRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserPreferencesController extends BaseApiController
{
    public function __construct(private UserService $userService)
    {
    }

    public function store(AddPreferencesRequest $request)
    {
        $this->userService->refreshPreferences(new UserPreferencesDto($request->sources, $request->categories, $request->authors));

        return $this->successResponse();
    }

    public function index(Request $request)
    {
        $data = $this->userService->getMyPreferences();

        return $this->successResponse($data);
    }

}
