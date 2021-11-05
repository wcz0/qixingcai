<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QixingcaiController extends Controller
{
    public function getMaxGroup(Request $request)
    {
        // 获取历史开奖相同号码
        $data = DB::table('qixingcai')
            ->select(
                DB::raw('CONCAT(one, two,three, four, five, six, seven) as number'),
                DB::raw('COUNT(*) as num'),
            )
            ->groupByRaw('number')
            ->orderBy('num', 'desc')
            ->get();

        return $this->success($data);
    }

    // 获取未开奖过的号码
    public function getNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'num' => 'nullable|integer',
        ]);
        if($validator->fails()){
            return $this->fial($validator->errors()->all());
        }
        $num = 1;
        if($request->filled($num)){
            $num = $request->num;
        }
        $numbers = [];

        for (; count($numbers) < $num;) {
            $int = [];
            for ($j=0; $j < 7 ; $j++) {
                if($j == 6){
                    $int[] += mt_rand(0, 14);
                    break;
                }
                $int[] += mt_rand(0, 9);
            }
            $verify = DB::table('qixingcai')
                ->select('id')
                ->where('one', $int[0])
                ->where('two', $int[1])
                ->where('three', $int[2])
                ->where('four', $int[3])
                ->where('five', $int[4])
                ->where('six', $int[5])
                ->where('five', $int[6])
                ->first();
            if($verify){
                continue;
            }else{
                $numbers[] = $int;
            }
        }

        return $this->success($numbers);
    }

}
