<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // 抓取七星彩官网数据
        $response = Http::get('https://webapi.sporttery.cn/gateway/lottery/getHistoryPageListV1.qry?gameNo=04&provinceId=0&pageSize=21126&isVerify=1&pageNo=1');

        $array = $response->json();

        $data = $array['value']['list'];
        $input = [];
        foreach ($data as $v) {
            $array = explode(' ', $v['lotteryDrawResult']);
            $input[] = [
                'id' => $v['lotteryDrawNum'],
                'one' => $array[0],
                'two' => $array[1],
                'three' => $array[2],
                'four' => $array[3],
                'five' => $array[4],
                'six' => $array[5],
                'seven' => $array[6],
                'post_time' => $v['lotterySaleEndtime'],
                'created_at' => now(),
            ];
        }
        $result = DB::table('qixingcai')
            ->insert($input);
        return $result;
    }
}
