<?php

namespace App\Console\Commands;

use App\Tools\Curl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use function PHPSTORM_META\type;

class ImportCityCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    static public $level = [
        'country'  => 0,
        'province' => 1,
        'city'     => 2,
        'district' => 3,
    ];


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
        //$dir = '/Users/yangshuo/Downloads/AMap_adcode_citycode.xlsx';
        //$is_exits = file_exists($dir);
        //if ($is_exits) {
        //    $content = fopen($dir, 'r+');
        //    var_dump($content);
        //}
        //var_dump($is_exits);exit;
        $conf = config('third')['gaode'];
        $key = $conf['key'];
        $district = $conf['api']['district'];
        $host = $district['url'];
        $method = strtolower($district['method']);

        //this->import();

        //$this->importCity();
        $startTime = microtime(true);
        $this->importDistrict();
        $endTime = microtime(true);
        echo '耗时: ' . round($endTime - $startTime, 3) . " 秒\n";
        echo '内存: ' . memory_get_usage();

    }


    public function importProvinces()
    {
        $conf = config('third')['gaode'];
        $key = $conf['key'];
        $district = $conf['api']['district'];
        $url = $district['url'];
        $method = strtolower($district['method']);

        $params = ['key' => $key,];

        $url = $url .'?'. http_build_query($params);
        $res = Curl::$method($url);

        if (empty($res)) {
            echo 'something wrong!';
            exit;
        } else {
            $resArr = json_decode($res, true);
            if ($resArr['status'] == 0) {
                throw new \Exception('errmsg:' . $resArr['info']);
            }

            $districts = $resArr['districts'];

            $arr = [];

            foreach ($districts as $value) {

                if (isset($value['districts']) && !empty($value['districts'])) {
                    $provinces = $value['districts'];

                    foreach ($provinces as $province) {
                        $tem['name']  = $province['name'];
                        $tem['pid']   = 1;
                        $tem['level'] = 1;
                        $tem['code']  = $province['adcode'];
                        $arr[] = $tem;
                    }
                }

            }

            $res = DB::table('city_code_map')->insert($arr);
            Log::info('插入结果:' . json_encode($res));
        }
    }

    public static $data = ['name' => '', 'pid' => 2, 'level' => 2, 'code' => ''];

    public function importCity()
    {
        $conf = config('third')['gaode'];
        $key = $conf['key'];
        $district = $conf['api']['district'];
        $host = $district['url'];
        $method = strtolower($district['method']);

        $provinces = DB::table('city_code_map')->where('level', 1)->get()->toArray();
        //var_dump($provinces);exit;
        $cityArr = [];

        foreach ($provinces as $item => $value) {

            $params = ['key' => $key, 'keywords' => $value->code, 'subdistrict' => 1];
            $url = $host .'?'. http_build_query($params);     // 卡了半天 ，因为之前一直用的$url = $url .  url在循环外面定义的
            $res = Curl::$method($url);

            if (empty($res)) {
                exit('Request Failed');
            } else {
                $resArr = json_decode($res, true);

                if ($resArr['status'] == 0) {
                    throw new \Exception('errmsg:' . $resArr['info']);
                }


                $districts = $resArr['districts'][0]['districts'];
                foreach ($districts as $district) {
                    $temp['name']  = $district['name'];
                    $temp['pid']   = $value->id;
                    $temp['level'] = 2;
                    $temp['code']  = $district['adcode'];
                    $cityArr[] = $temp;
                }

            }

        }

        $res = DB::table('city_code_map')->insert($cityArr);
        Log::info('插入结果:' . json_encode($res));
    }

    public function importDistrict()
    {
        $conf = config('third')['gaode'];
        $key = $conf['key'];
        $district = $conf['api']['district'];
        $host = $district['url'];
        $method = strtolower($district['method']);

        $provinces = DB::table('city_code_map')->where('id', '>', 99)->where('level', 2)->get()->toArray();

        $cityArr = [];
        DB::beginTransaction();
        try {
            foreach ($provinces as $item => $value) {

                $params = ['key' => $key, 'keywords' => $value->code, 'subdistrict' => 1];
                $url = $host .'?'. http_build_query($params);     // 卡了半天 ，因为之前一直用的$url = $url .  url在循环外面定义的
                $res = Curl::$method($url);

                if (empty($res)) {
                    exit('Request Failed');
                } else {
                    $resArr = json_decode($res, true);

                    if ($resArr['status'] == 0) {
                        throw new \Exception('errmsg:' . $resArr['info']);
                    }


                    $districts = $resArr['districts'][0]['districts'];

                    foreach ($districts as $district) {
                        $temp['name']  = $district['name'];
                        $temp['pid']   = $value->id;
                        $temp['level'] = 3;
                        $temp['code']  = $district['adcode'];
                        $cityArr[] = $temp;
                    }

                }

            }
            $res = DB::table('city_code_map')->insert($cityArr);
            Log::info(__FUNCTION__ . ' 插入结果: ' . json_encode($res));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception('操作失败: ' . $exception->getMessage());
        }

    }
}


