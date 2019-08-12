<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\libs\SocketService;

class Send extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:socket';

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
        $data = [
            [
                'id' => 1,
                'name' => 'one',
                'child' => [
                    'id' => 2,
                    'name' => 'two',
                    'child' => [
                        'id' => 3,
                        'name' => 'three',
                        'child' => [
                            'id' => 4,
                            'name' => 'four',
                            'child' => [

                            ]
                        ]
                    ]
                ]
            ]
        ];

        $target = 4;

        var_dump($this->find($data, $target));
        exit;

    }

    public function find($data, $m)
    {
        static $res = [];

        foreach ($data as $key => $val) {
var_dump($data);
var_dump($val['id']);
            if ($m == $val['id']) {
                return $res;
            }

            if (isset($val['child']) && !empty($val['child'])) {
                $res[] = $val['name'];
                $this->find($val['child'], $m);
            }
        }


    }
}
