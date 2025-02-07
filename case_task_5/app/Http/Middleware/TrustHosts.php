<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware {
    /**
     * Получить шаблоны хостов, которым следует доверять.
     *
     * @return array
     */
    public function hosts() {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
