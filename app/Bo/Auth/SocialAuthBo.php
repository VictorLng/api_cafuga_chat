<?php

namespace App\Bo;

use App\Models\SocialAccount;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthBo {


    public function __construct() {

    }

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        try {

            $socialUser = Socialite::driver($provider)->user();

            DB::beginTransaction();

            $socialAccount = SocialAccount::firstOrNew([
                'provider_name' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);

            if ($socialAccount->exists && $socialAccount->user_id) {
                $user = $socialAccount->user;
            } else {
                $user = User::where(['email' => $socialUser->getEmail()])->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'password' => bcrypt(Str::random(16)),
                    ]);
                }

                $socialAccount->user_id = $user->id;
                $socialAccount->save();
            }

            $token = $user->createToken('UserToken')->accessToken;

            DB::commit();

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('login')->with('error', 'Something went wrong');
        }
    }
}