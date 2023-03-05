<?php

namespace App\Http\Middleware;

use App\Support\Traits\AmoCRMTrait;
use Closure;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthTokenCheck
{
    use AmoCRMTrait;

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->tokenCheck()) {
            return redirect()->route('auth.view');
        }

        return $next($request);
    }
}
