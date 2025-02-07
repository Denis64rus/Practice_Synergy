<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware {
    /**
     * Указывает, следует ли устанавливать cookie-файл XSRF-TOKEN в ответе.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * URI, которые следует исключить из проверки CSRF.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
