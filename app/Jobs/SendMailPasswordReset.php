<?php

namespace App\Jobs;

use App\Mail\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailPasswordReset implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $route;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $route
     * @param string $name
     * @return void
     */
    public function __construct(string $email, $route, string $name)
    {
        $this->email = $email;
        $this->route = $route;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->email)->send(new PasswordReset($this->route, $this->name));
    }
}
