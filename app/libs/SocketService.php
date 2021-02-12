<?php
/**
 * @date 2019/7/24
 */


namespace App\libs;

use Illuminate\Log\Logger;


class SocketService
{
    //请求超时时间 (微秒)
    const TIME_OUT_USEC = 200000;

    private $ip = '';

    private $port = '';


    public function __construct($config)
    {
        $this->ip = $config['ip'];
        $this->port = $config['port'];

    }

    public function connect()
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ($socket === false) {
            Logger::error("socket_create() failed: reason: " . socket_strerror(socket_last_error()));
            return false;
        }

        socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);//1表示接受所有的数据包

        if (socket_bind($socket, $this->ip, $this->port) === false) {
            Logger::error("socket_bind() failed: reason: " . socket_strerror(socket_last_error()));
            return false;
        }

        if (socket_listen($socket) === false) {
            Logger::error("socket_listen() failed: reason: " . socket_strerror(socket_last_error()));
            return false;
        }

        do {
            if (($msgSock = socket_accept($socket)) === false) {
                Logger::error("socket_accept() failed: reason: " . socket_strerror(socket_last_error()));
                return false;
            }

            Logger::info($msgSock);
        } while(true);

        socket_close($socket);
    }
}