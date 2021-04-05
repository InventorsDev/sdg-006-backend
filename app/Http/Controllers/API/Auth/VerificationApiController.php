<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Auth;

class VerificationApiController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function verify(Request $request)
    {
        // auth()->loginUsingId($request->route('id'));
        // return $request->route('id');
        $user = User::find($request->route('id'));
        Auth::login($user);
        // JWTAuth::fromUser($user);
        // return $user->toArray();
        // $token = auth()->attempt($user->toArray());
        // auth()->attempt(["id"=>$request->route('id')]);
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return response(['message'=>'your email has Already been verified']);
        }
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response(['message'=>'Successfully verified']);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response(['message'=>'Already verified']);
        }

        $request->user()->sendEmailVerificationNotification();

        if($request->wantsJson()) {
            return response(['message'=>'email sent']);
        }

        return back()->with('resent', true);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
