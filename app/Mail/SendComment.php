<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendComment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment,$date,$feedback,$redate,$url,$subject)
    {
        $this->comment = $comment;
        $this->date = $date;
        $this->feedback = $feedback;
        $this->redate = $redate;
        $this->url = $url;
        $this->subject = $subject;
        $this->title = 'موسوعة الحديث تعليق علي ,'.' '. $subject ;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)->view('admins.email')
            ->with([
                'comment' => $this->comment,
                'feedback' => $this->feedback,
                'date' => $this->date,
                'redate' => $this->redate,
                'url' => $this->url,
                'subject' => $this->subject
            ]);
    }
}
