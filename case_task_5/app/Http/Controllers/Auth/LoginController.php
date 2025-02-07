<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Контроллер обрабатывает аутентификацию пользователей для приложения и
    | перенаправляет их на домашний экран.
    */

    use AuthenticatesUsers;

    /**
     * Перенаправление пользователей после входа в систему.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Создать новый экземпляр контроллера.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
}
