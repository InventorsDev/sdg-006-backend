<?php

namespace App\Http\Controllers\API\Shared\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\Shared\ChangePasswordRequest;
use App\Repositories\Eloquent\Shared\User\UserRepositoryInterface; 

class UpdateAccountPassword extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware(['auth:api']);
        $this->userRepository = $userRepository;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        try {
            $this->userRepository->updateAccountPassword($request->validated());
            return response()->json(["success"=> ["message"=>"Your account password has been changed successfully"]], 200);
        } catch (\Exception $e) {
            return response()->json(["error"=> ["message"=>"Try Again. If it persist contact system Administrator"]], 500);
        }
    }
}
