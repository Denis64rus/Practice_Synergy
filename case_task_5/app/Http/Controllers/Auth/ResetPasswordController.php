<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Контроллер отвечает за обработку запросов на сброс пароля.
    |
    */

    use ResetsPasswords;

    /**
     * Перенаправление пользователей после сброса пароля.
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
        $this->middleware('guest');
    }
}
