<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware {
    /**
     * Названия атрибутов, которые не следует обрезать.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
