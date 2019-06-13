<?php
/**
 * @date 2019/4/27
 */

return [

    // 高德
    'gaode' => [
        'key' => 'caee842bfccc97394264c992c308dc21',
        'api' => [
            'weatherInfo' => ['url' => 'https://restapi.amap.com/v3/weather/weatherInfo', 'method' => 'GET'],
            'district' => ['url' => 'https://restapi.amap.com/v3/config/district', 'method' => 'GET'],
        ]
    ],

    'JingDong' => [
        'key' => '5812b2702cea21d7a47b39c513d8c27b',
        'api' => [
            'dictionary_district' => ['url' => 'https://way.jd.com/RTBAsia/dictionary_district'],
        ]
    ],


    'targetAdd' => [
        'me' => [
            'email' => '3546544379@qq.com',
            'city' => '朝阳',
        ],
        'zhou' => [
            'email' => '534913361@qq.com',
            'city' => '绥滨',
        ],
        'zhang' => [
            'email' => '812330104@qq.com',
            'city' => '哈尔滨',
        ],
    ],

    'cityCode' => [
        '北京' => '110100',
        '朝阳' => '110105',
        '绥滨' => '230422',
        '河北区' => '120105',
        '哈尔滨' => '230100',
        '上海' => '310000',
    ],
];
