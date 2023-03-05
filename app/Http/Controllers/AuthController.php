<?php

namespace App\Http\Controllers;

use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use App\Http\Requests\CodeRequest;
use App\Models\Token;
use App\Support\Traits\AmoCRMTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use JsonException as JsonExceptionAlias;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthController extends Controller
{
    use AmoCRMTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function view() : \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('auth');
    }

    /**
     * @param CodeRequest $request
     * @return RedirectResponse
     * @throws AmoCRMoAuthApiException
     * @throws ContainerExceptionInterface
     * @throws JsonExceptionAlias
     * @throws NotFoundExceptionInterface
     */
    public function processCodeAuth(CodeRequest $request) : RedirectResponse
    {
        $accessToken = $this->getAccessTokenUsingCode($request->code);

        if (!$accessToken->hasExpired()) {
            $this->saveToken(
                [
                    'accessToken' => $accessToken->getToken(),
                    'refreshToken' => $accessToken->getRefreshToken(),
                    'expires' => $accessToken->getExpires(),
                    'values' => json_encode($accessToken->getValues(), JSON_THROW_ON_ERROR),
                ]
            );

            return redirect()->route('deal.list');
        }

        return redirect()->route('auth.view')->withErrors(
            [
                'code' => 'Ошибка авторизации'
            ]
        );
    }

    /**
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function logout() : RedirectResponse
    {
        Token::where('hash', session()->get('hash'))->delete();

        session()->forget('hash');

        return redirect()->route('auth.view');
    }
}
