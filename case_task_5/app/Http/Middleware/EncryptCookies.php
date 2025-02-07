<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware {
    /**
     * Имена файлов cookie, которые не следует шифровать.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
