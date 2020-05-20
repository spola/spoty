<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Ejemplo:
        //Mail::to(User::find(4))->send(new App\Mail\UserCreated());
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.user_created', [
            'url'           => config('app.url'),
            'pathToImage'   => 'images/logo_aplica2_original.png',
            'app_name'      => config('app.name')
        ]);
    }
}
