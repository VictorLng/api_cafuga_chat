<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Bo\SocialAuthBo;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialUser;
use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\DB;

class SocialAuthBoTest extends TestCase
{
    public function testRedirectToProvider()
    {
        $provider = 'discord';
        Socialite::shouldReceive('driver')
            ->with($provider)
            ->andReturnSelf();
        Socialite::shouldReceive('redirect')
            ->andReturn('mock_redirect_url');

        $socialAuthBo = new SocialAuthBo();
        $response = $socialAuthBo->redirectToProvider($provider);

        $this->assertEquals('mock_redirect_url', $response);
    }

    public function testHandleProviderCallback()
    {
        $provider = 'discord';

        $mockSocialUser = Mockery::mock(SocialUser::class);
        $mockSocialUser->shouldReceive('getId')->andReturn('12345');
        $mockSocialUser->shouldReceive('getEmail')->andReturn('test@example.com');
        $mockSocialUser->shouldReceive('getName')->andReturn('Test User');

        Socialite::shouldReceive('driver')
            ->with($provider)
            ->andReturnSelf();
        Socialite::shouldReceive('user')
            ->andReturn($mockSocialUser);

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        $mockUser = Mockery::mock(User::class);
        $mockUser->shouldReceive('createToken')
            ->with('UserToken')
            ->andReturn((object)['accessToken' => 'mock_token']);

        User::shouldReceive('where')
            ->with(['email' => 'test@example.com'])
            ->andReturnSelf();
        User::shouldReceive('first')
            ->andReturn(null);
        User::shouldReceive('create')
            ->andReturn($mockUser);

        $mockSocialAccount = Mockery::mock(SocialAccount::class);
        $mockSocialAccount->shouldReceive('firstOrNew')
            ->with([
                'provider_name' => $provider,
                'provider_id' => '12345',
            ])
            ->andReturnSelf();
        $mockSocialAccount->shouldReceive('exists')->andReturn(false);
        $mockSocialAccount->shouldReceive('save')->once();

        $socialAuthBo = new SocialAuthBo();
        $response = $socialAuthBo->handleProviderCallback($provider);

        $this->assertArrayHasKey('token', $response->getData(true));
        $this->assertArrayHasKey('user', $response->getData(true));
        $this->assertEquals('mock_token', $response->getData(true)['token']);
    }
}
