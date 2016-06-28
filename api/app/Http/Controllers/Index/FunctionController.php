<?php
namespace  App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Http\Model\Market;
use App\Http\Model\Subsection;
use Illuminate\Http\Request;

/**
 * description : 公共方法
 * date        : 2016-02-01
 * author      : guanxu
 */
Class FunctionController extends Controller {

     

    public function subsectionToMarket(Request $request) {
        $subsection   = $request->input("subsection_id");
        if($subsection == '') return '';
        $market = Market::subsectionToMarket($subsection)->toArray();
        if(empty($market)) return '';
        return json_encode($market);
    }
}