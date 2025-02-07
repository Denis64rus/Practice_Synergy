<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware {
    /**
     * Полученине пути, по которому следует перенаправить пользователя, если он не аутентифицирован.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request) {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
