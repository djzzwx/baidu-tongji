# baidu-tongji
百度统计 SDK.

## 环境要求

- PHP >= 5.6
- [Composer](https://getcomposer.org/)

## 安装

```shell
$ composer require "rr-earring/baidu-tongji" -vvv
```

## 使用

```php
<?php

use RrEarring\BaiduTongji\Factory;

// 当前仅确定百度商业账号可用，百度账号暂无可测试账号

$config = [
    'is_business'   => true, // is business account
    'username'      => '', // business required
    'password'      => '', // business required
    'token'         => '', // business required
    'access_token'  => '', // personal required
    'site_id'       => 0, // site_id
    'response_type' => 'array', // return
    'log'           => [
        'file' => './baidu-tongji.log', // logfile
    ],
];

$baiduApi = Factory::baiduApi($config);


// sitelist
$baiduApi->list->get();

// overview/getTimeTrendRpt
$baiduApi->time_trend_rpt->get(20220425, 20220426, 'pv_count,visitor_count,ip_count');

// overview/getDistrictRpt
$baiduApi->district_rpt->get(20220425, 20220426, 'pv_count');

// overview/getCommonTrackRpt
$baiduApi->common_track_rpt->get(20220425, 20220426);

// trend/time/a
$baiduApi->time->get(20220425, 20220426, 'pv_count,avg_visit_time', ['gran' => 'day', 'source' => 'through', 'clientDevice' => 'pc', 'area' => 'china']);

// trend/latest/a
$baiduApi->latest->get('area,searchword,visit_time,visit_pages', 'visit_pages,desc', 100, ['source' => 'through', 'area' => 'china']);

// pro/product/a
$baiduApi->product->get(20220425, 20220426, 'show_count,pv_count,bounce_ratio');

// pro/hour/a
$baiduApi->hour->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');

// source/all/a
$baiduApi->all->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');

// source/engine/a
$baiduApi->engine->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');

// source/searchword/a
$baiduApi->searchword->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');

// source/link/a
$baiduApi->link->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');

// custom/media/a
$baiduApi->media->get(20220425, 20220426, 'visit_count,visitor_count', 'plan');

// visit/toppage/a
$baiduApi->toppage->get(20220425, 20220426, 'pv_count,visitor_count');

// visit/topdomain/a
$baiduApi->topdomain->get(20220425, 20220426, 'visit_count,visitor_count');

// visit/landingpage/a
$baiduApi->landingpage->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');

// visit/district/a
$baiduApi->district->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');

// visit/world/a
$baiduApi->world->get(20220425, 20220426, 'pv_count,visit_count,visitor_count');


```

## Features
- [x] [Web服务API](https://tongji.baidu.com/api/manual/)

## License

MIT
