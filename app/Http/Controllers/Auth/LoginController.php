<?php

namespace App\Http\Controllers\Auth;

use App\DTO\CredentialDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ResponseResource;
use App\Services\AuthService;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(
        private AuthService $authSrv,
    )
    {
        //
    }

    /**
     * Handle the incoming request.
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): ResponseResource
    {
        $token = $this->authSrv->createToken(new CredentialDTO(
            $request->mobile, $request->password,
        ));

        return new ResponseResource(['token' => $token]);
    }
}
