<?php

namespace App\Mail\Update;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $file;//mora da se kla public za da mozi da gi zemi
    public $user;
    public function __construct(File $file)
    {
        $this->file=$file;

        $this->user=$file->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('your file updates have been uproved')->view('email.file.update.approved');
    }
}
