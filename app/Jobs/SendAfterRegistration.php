<?php

namespace App\Jobs;

use App\Mail\AccountAccept;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendAfterRegistration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $route;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $route
     * @return void
     */
    public function __construct(string $email, string $route)
    {
        $this->email = $email;
        $this->route = $route;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->email)->send(new AccountAccept($this->route));
    }
}
