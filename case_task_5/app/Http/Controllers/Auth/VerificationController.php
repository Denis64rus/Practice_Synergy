<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | Контроллер отвечает за обработку проверки электронной почты для любого
    | пользователя, который недавно зарегистрировался в приложении. Электронные письма также могут быть
    | отправлены повторно, если пользователь не получил исходное сообщение электронной почты.
    |
    */

    use VerifiesEmails;

    /**
     * Куда перенаправлять пользователей после проверки.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Создайте новый экземпляр контроллера.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
