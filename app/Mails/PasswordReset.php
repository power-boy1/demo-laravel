<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    private $route;
    private $name;

    /**
     * Create a new message instance.
     *
     * @param $route <p>
     * @param $name <p>
     * auth token
     * </p>
     * @return void
     */
    public function __construct($route, $name)
    {
        $this->route = $route;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.reset')
                    ->with(['route' => $this->route, 'name' => $this->name]);
    }
}
