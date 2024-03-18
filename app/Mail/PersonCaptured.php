<?php
namespace App\Mail;

use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class PersonCaptured extends Mailable
{
    use Queueable, SerializesModels;

    public $person, $type_;

    public function __construct(Person $person, $type_)
    {
        $this->person = $person;
        $this->type_ = $type_;
    }

    public function build()
    {
        return $this->view('emails.captured.person_captured')
                    ->subject('Person '.ucfirst($this->type_).' Notification');
    }
}
