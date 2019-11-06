<?php

namespace App\Mail\Files;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FileRejected extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     *
     *
     */
    public $file;
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
        return $this->subject('your file has been rejected')->view('email.file.new.rejected');//mu go prajcame vieto so poraka
    }
}
