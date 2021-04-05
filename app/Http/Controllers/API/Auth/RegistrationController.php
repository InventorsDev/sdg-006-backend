<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\AccountCreated;
use App\Http\Requests\Auth\UserRegistrationRequest;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserRegistrationRequest $request)
    {
        $user = User::create($request->validated());
        AccountCreated::dispatch($user);
       return response()->json(['message' => 'registered sucessfully. A verification link has been sent to your email'], 200);
    }
}
