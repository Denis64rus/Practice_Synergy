<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Контроллер отвечает за обработку писем для сброса пароля и отправляет
    | уведомления из приложения  пользователям.
    */

    use SendsPasswordResetEmails;

    /**
     * Создать новый экземпляр контроллера.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }
}
