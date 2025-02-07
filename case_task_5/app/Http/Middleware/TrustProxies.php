<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware {
    /**
     * Доверенные прокси-серверы для приложения.
     *
     * @var array|string
     */
    protected $proxies;

    /**
     * headers, которые следует использовать для обнаружения прокси.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
