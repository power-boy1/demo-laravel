<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountAccept extends Mailable
{
    use Queueable, SerializesModels;

    private $route;

    /**
     * Create a new message instance.
     *
     * @param $route <p>
     * auth token
     * </p>
     * @return void
     */
    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.account-accept')
                    ->with(['route' => $this->route]);
    }
}
