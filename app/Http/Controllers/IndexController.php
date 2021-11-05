<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // 抓取七星彩官网数据
        $response = Http::get('https://webapi.sporttery.cn/gateway/lottery/getHistoryPageListV1.qry?gameNo=04&provinceId=0&pageSize=30&isVerify=1&pageNo=1');

        $array = $response->json();

        $data = $array['value']['list'];
        foreach ($data as $v) {
            # code.
        }
        return dump($response->json());
        // 写入数据库
    }
}
