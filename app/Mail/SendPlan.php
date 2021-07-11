<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPlan extends Mailable
{
    use Queueable, SerializesModels;
    
    public $doctor;
    public $user;
    public $plans;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->plans = $user->plans;
        $this->doctor = $user->doctor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject("Plan for treatment")
            ->from($this->doctor->email)
            ->view('emails.doctor.plan',[
                'doctor' => $this->doctor
            ]);
        foreach ($this->plans as $plan)
        {
            $pathAlias = "storage/pdf/".$this->user->id."/$plan->attachment";
            $path = public_path($pathAlias);
            $mail->attach($path);
        }
        return $mail;
    }
}
