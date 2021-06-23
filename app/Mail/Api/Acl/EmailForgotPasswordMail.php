<?php

namespace App\Mail\Api\Acl;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForgotPasswordMail extends Mailable
{
	use Queueable, SerializesModels;
	public $details;
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($details)
	{
		$this->details = $details;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject('Mail for Forgot Password')
			->view('emails.api.acl.EmailForgotPasswordMail');
	}
}
