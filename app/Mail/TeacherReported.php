<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Services\DTO\TeacherReportedData;

use App\User;
use App\Grade;

class TeacherReported extends Mailable
{
    use Queueable, SerializesModels;

    private TeacherReportedData $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TeacherReportedData $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.teacher_report', [
            'url'           => config('app.url'),
            'pathToImage'   => 'images/logo_externo.png',
            'app_name'      => config('app.name'),

            'teacher'           => $this->data->teacher->name,
            'activities_count'  => $this->data->activities_count,
            'done_count'        => $this->data->done_count,
            'no_done_count'     => $this->data->no_done_count,
            'students'          => $this->data->students,
        ]);
    }
}
