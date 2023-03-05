<?php

namespace App\Support\Traits;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use App\Models\Token;
use Illuminate\Support\Str;
use JsonException as JsonExceptionAlias;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait AmoCRMTrait
{
    /**
     * @return AmoCRMApiClient
     */
    private function _getApiClient() : AmoCRMApiClient
    {
        return new AmoCRMApiClient(
            config('amoCRM.integration_id'),
            config('amoCRM.secret_key'),
            config('amoCRM.redirect_url')
        );
    }

    /**
     * @return Token|null
     */
    public function getToken() : Token|null
    {
        return Token::where('hash', session('hash'))->first();
    }

    /**
     * @return AccessToken
     * @throws JsonExceptionAlias
     */
    public function _getAccessToken() : AccessToken
    {
        $token = $this->getToken();

        return new AccessToken([
            'access_token' => $token?->accessToken,
            'refresh_token' => $token?->refreshToken,
            'expires' => $token?->expires,
            'values' => json_decode($token->values, false, 512, JSON_THROW_ON_ERROR)
        ]);
    }

    /**
     * @return AmoCRMApiClient
     * @throws JsonExceptionAlias
     */
    public function getObjectAmoCRM() : AmoCRMApiClient
    {
        $apiClient = $this->_getApiClient();

        $accessToken = $this->_getAccessToken();
        $baseDomain = config('amoCRM.base_domain');

        $apiClient->setAccessToken($accessToken)
            ->setAccountBaseDomain($baseDomain)
            ->onAccessTokenRefresh(
                function (AccessTokenInterface $accessToken, string $baseDomain) {
                    $this->saveToken(
                        [
                            'accessToken' => $accessToken->getToken(),
                            'refreshToken' => $accessToken->getRefreshToken(),
                            'expires' => $accessToken->getExpires(),
                            'baseDomain' => $baseDomain,
                        ]
                    );
                });

        return $apiClient;
    }

    /**
     * @param string $code
     * @return AccessTokenInterface
     * @throws AmoCRMoAuthApiException
     */
    public function getAccessTokenUsingCode(string $code): AccessTokenInterface
    {
        $oauth = $this->_getApiClient()->getOAuthClient();

        $oauth->setBaseDomain(
            config('amoCRM.base_domain')
        );

        return $oauth->getAccessTokenByCode($code);
    }

    /**
     * @param array $array
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saveToken(array $array) : void
    {
        $hash = session()->get('hash');

        if (!$hash) {
            $hash = Str::random(40);
        }

        session(['hash' => $hash]);

        Token::UpdateOrCreate(
            [
                'hash' => $hash
            ],
            $array
        );
    }

    /**
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function tokenCheck() : bool
    {
        $hash = session()->get('hash');

        if (!$hash) {
            return false;
        }

        if (!$this->getToken()) {
            return false;
        }

        return true;
    }
}
