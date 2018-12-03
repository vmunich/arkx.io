<?php

namespace App\Http\ViewComposers\Shared;

use Illuminate\Contracts\View\View;
use Illuminate\Encryption\Encrypter;

class EncryptedCsrfTokenComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view): void
    {
        $encryptedCsrfToken = app(Encrypter::class)->encrypt(csrf_token());

        $view->with(compact('encryptedCsrfToken'));
    }
}
