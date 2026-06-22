<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;

class CsrfProtection
{
    
    protected array $except = [
        // 'api/webhook',
    ];


    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isExcluded($request)) {
            return $next($request);
        }

        if ($this->requiresVerification($request)) {
            $this->verify($request);
        }

        return $next($request);
    }

    /**
     * Verifikasi CSRF token dari request.
     * Mendukung form POST biasa dan AJAX (header X-CSRF-TOKEN / X-XSRF-TOKEN).
     *
     * @throws TokenMismatchException
     */
    protected function verify(Request $request): void
    {
        $sessionToken = $request->session()->token();
        $requestToken = $this->getTokenFromRequest($request);

        if (empty($requestToken) || !hash_equals($sessionToken, $requestToken)) {
            throw new TokenMismatchException('CSRF token tidak valid atau tidak ditemukan.');
        }
    }


    protected function getTokenFromRequest(Request $request): string
    {
        // 1. Dari form input biasa
        $token = $request->input('_token');

        // 2. Dari header AJAX (X-CSRF-TOKEN)
        if (empty($token)) {
            $token = $request->header('X-CSRF-TOKEN');
        }

        // 3. Dari cookie X-XSRF-TOKEN (Axios / Vue / React default)
        if (empty($token)) {
            $token = $request->header('X-XSRF-TOKEN');
        }

        return (string) $token;
    }
    
    protected function requiresVerification(Request $request): bool
    {
        return in_array(strtoupper($request->method()), ['POST', 'PUT', 'PATCH', 'DELETE']);
    }


    protected function isExcluded(Request $request): bool
    {
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }
        return false;
    }
}