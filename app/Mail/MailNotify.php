<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;

use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
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
        Log::info($this->data);
        if($this->data['action'] == 'bantuan'){
            $data = $this->from($this->data['from_mail'],$this->data['subject']);
        }else{
            $data = $this->from(env('MAIL_FROM_ADDRESS'),$this->data['subject']);
        }
        $data = $data->subject($this->data['judul']);
        if($this->data['action'] == 'verifikasi'){
            $data = $data->view('emails.verifikasi')->with('data',$this->data); 
        }
        if($this->data['action'] == 'bantuan'){
            $data = $data->view('emails.bantuan')->with('data',$this->data); 
        }
        if($this->data['action'] == 'register'){
            $data = $data->view('emails.registrasi')->with('data',$this->data); 
        }
        if($this->data['action'] == 'resend_aktivasi'){
            $data = $data->view('emails.resend_aktivasi')->with('data',$this->data); 
        }
        if($this->data['action'] == 'send_forgot_password'){
            $data = $data->view('emails.send_forgot_password')->with('data',$this->data); 
        }
        
        return $data;
    }
}
