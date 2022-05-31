<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthCode extends Mailable
{
    use Queueable, SerializesModels;

    protected $code;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param string $code
     * @param User $user
     */
    public function __construct(string $code, User $user)
    {
        $this->code = $code;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.code')->with([
            'code' => $this->code,
            'user' => $this->user,
        ]);
    }
}
