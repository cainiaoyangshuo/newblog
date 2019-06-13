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

    public $city;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($res, $city)
    {
        //
        $this->res = $res;
        $this->city = $city;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $info = $this->city;
        $subject = sprintf("%s今天%s 最高气温%s°，最低气温%s°  %s ", $info['rainToday'], $info['city'], $info['rainToday'], $info['dayTemp'], $info['nightTemp'], $info['tips']);

        return $this->subject($subject)->view('commands.weather');
    }
}
