<?php

namespace App\Resources;

class SocialAccountData
{
    public $provider;
    public $provider_id;
    public $user_id;

    public function setProvider($provider)
    {
        $this->provider = $provider;
    }
    public function setProviderId($provider_id)
    {
        $this->provider_id = $provider_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getProvider()
    {
        return $this->provider;
    }
    public function getProviderId()
    {
        return $this->provider_id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
}