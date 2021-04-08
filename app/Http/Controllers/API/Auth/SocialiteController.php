<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;
use App\Traits\Auth\AuthResponse;

class SocialiteController extends Controller
{
    use AuthResponse;
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function handleGoogleCallback()
    {
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->stateless()->user();
            // if the user exits, use that user and login
            // dd($user->user['family_name']);
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                $token = auth('api')->login($finduser);
                return $this->respondWithToken($token);
            }else{
                //user is not yet created, so create first
                $newUser = User::create([
                    'firstname' => $user->user['given_name'],
                    'lastname' => $user->user['family_name'],
                    'email' => $user->user['email'],
                    'google_id'=> $user->user['id'],
                    'password' => $user->user['family_name'],
                    'phone_number' => "987654",
                ]);
                //login as the new user
                $token = auth('api')->login($newUser);
                return $this->respondWithToken($token);
            }
            //catch exceptions
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
