<?php

namespace app\common\controller;

use app\BaseController;

class RestBaseController extends BaseController
{


    public function success($data = [], $msg = '请求成功', $code = 1)
    {
        return $this -> returnJson($code, $msg, $data);
    }


    public function error($code = 0, $msg = '请求失败', $data = [])
    {
        return $this -> returnJson($code, $msg, $data);
    }


    public function returnJson($code, $msg, $data = [])
    {
        $returnData = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        return json($returnData);
    }


}