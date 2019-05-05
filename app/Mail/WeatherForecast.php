<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeatherForecast extends Mailable
{
    use Queueable, SerializesModels;

    public $res;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($res)
    {
        //
        $this->res = $res;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        foreach ($this->res as $re) {
//            var_dump($re['date']);
//        }
//        exit;
////var_dump($this->res);exit;
        return $this->view('commands.weather');
    }
}
