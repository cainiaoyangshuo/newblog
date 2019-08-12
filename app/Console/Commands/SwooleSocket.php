<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SwooleSocket extends Command
{
    public $ws;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole {action?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $action = $this->argument('action');
        switch ($action) {
            case 'close':

                break;

            default:
                $this->start();
                break;
        }

        return true;
    }

    public function start()
    {
        $this->ws = new \swoole_websocket_server("0.0.0.0", 9502);
var_dump($this->ws);
        ////监听WebSocket连接打开事件
        //$this->ws->on('open', function ($ws, $request) {
        //    var_dump($request->fd . "连接成功");
        //    // $ws->push($request->fd, "hello, welcome\n");
        //});
        //
        //$this->ws->on('message', function ($ws, $frame) {
        //    //fd绑定客户端传过来的标识uid
        //    var_dump($frame);
        //    $ws->bind((int)$frame->fd, (int)$frame->data);
        //});
        //
        //$this->ws->on('request', function ($request, $response) {
        //    // 接收http请求从post获取参数
        //    // 获取所有连接的客户端，验证uid给指定用户推送消息
        //    // token验证推送来源，避免恶意访问
        //    if ($request->post['token'] == '###' ) {
        //        $clients = $this->ws->getClientList();
        //        $clientId = [];
        //        foreach ($clients as $value) {
        //            $clientInfo = $this->ws->connection_info($value);
        //            if (array_key_exists('uid', $clientInfo) && $clientInfo['uid'] == $request->post['s_id']) {
        //                $clientId[] = $value;
        //            }
        //        }
        //        if (!empty($clientId)) {
        //            foreach ($clientId as $v) {
        //                $this->ws->push($v, $request->post['info']);
        //            }
        //        }
        //    }
        //    });
        //
        ////监听WebSocket连接关闭事件
        //$this->ws->on('close', function ($ws, $fd) {
        //    echo "client:{$fd} is closed\n";
        //});
        //
        //$this->ws->start();

    //监听WebSocket连接打开事件
        $this->ws->on('open', function ($ws, $request) {
            var_dump($request->fd, $request->get, $request->server);
            $ws->push($request->fd, "hello, welcome\n");
        });

//监听WebSocket消息事件
        $this->ws->on('message', function ($ws, $frame) {
            var_dump($frame);
            echo "Message: {$frame->data}\n";
            $ws->push($frame->fd, "server: {$frame->data}");
        });

//监听WebSocket连接关闭事件
        $this->ws->on('close', function ($ws, $fd) {
            echo "client-{$fd} is closed\n";
        });

        $this->ws->start();
    }
}
