<?php

namespace App\Mailers;
use App\User;
use Illuminiate\Contracts\Mail\Mailer;

class AppMailer {

	protected $mailer;
	protected $from = "noreply";
	protected $to;
	protected $subject;
	protected $view;
	protected $data = [];

	public function __construct(Mailer $mailer) {
		$this->mailer = $mailer;
	}

	public function deliver() {
		$this->mailer->send($this->view, $this->$data, function ($message) {
			$message->from($this->from, "Administrator")->to($this - to);
		});
	}

	public function welcome(User $user) {
		$this->to = $user->email;
		$this->view = 'emails.confirm';
		$this->data = compact('user');
		$this->deliver();
	}

}
