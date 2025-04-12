<?php

namespace App\Http\Controllers\Auth;

use App\Bo\Auth\SocialAuthBo;
use App\Http\Controllers\Controller;
class SocialAuthController extends Controller
{
    protected $socialAuthBo;
    public function __construct(SocialAuthBo $socialAuthBo) {
        $this->socialAuthBo = $socialAuthBo;
    }
    public function redirectToProvider(string $provider)
    {
        try{
           return $this->socialAuthBo->redirectToProvider($provider);
        }catch (\Exception $e) {
            dd("Erro :". $e);
            return response()->json(['error' => 'Unable to redirect to provider'], 500);
        }
    }

    public function handleProviderCallback(string $provider)
    {
        try{
            return $this->socialAuthBo->handleProviderCallback($provider);
        }catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Unable to handle provider callback'], 500);
        }
    }
}