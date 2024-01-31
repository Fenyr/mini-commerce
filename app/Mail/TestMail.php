<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use function Spatie\Ignition\ErrorPage\config;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $title;
    public $msg;

    public function __construct($title, $msg)
    {
        $this->title = $title;
        $this->msg = $msg;
    }

    public function build()
    {
        return $this->subject($this->title)->markdown("Email")->with(["title"=>$this->title, "msg"=>$this->msg]);
    }
}
