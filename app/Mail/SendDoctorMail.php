<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendDoctorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $username;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Credentials For Login')->view('emails.doctor.credential', [
            'username' => $this->username,
            'password' => $this->password,
        ]);
    }
}
