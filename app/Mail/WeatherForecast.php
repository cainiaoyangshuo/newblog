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
        $subject = sprintf("%s %s地区 %s 到 %s 的天气情况", $this->city['rainToday'], $this->city['city'], date('n月j号', time()), date('n月j号', strtotime('+4 day')));

        return $this->subject($subject)->view('commands.weather');
    }
}
