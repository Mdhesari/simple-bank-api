<?php

namespace App\Http\Controllers\User;

use App\DTO\UserTransactionFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    public function __construct(
        private UserService $userSrv
    )
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @param Request $request
     * @return ResponseResource
     */
    public function getRecent(Request $request): ResponseResource
    {
        $users = $this->userSrv->getRecent(new UserTransactionFilterDTO(now()->subMinutes(10)));

        return new ResponseResource($users);
    }
}
