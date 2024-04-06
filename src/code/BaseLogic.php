<?php

namespace app\common\logic;

class BaseLogic
{


    protected $errorCode;

    protected $errorMsg;

    protected $data = [];


    /**
     * @设置错误
     *
     */
    public function setError($error): void
    {
        $this -> errorCode = $error[0] ?? 0;
        $this -> errorMsg = $error[1] ?? '';
    }

    /**
     * 设置状态码
     *
     * @param mixed $errorCode
     */
    public function setErrorCode($errorCode): void
    {
        $this -> errorCode = $errorCode;
    }

    /**
     * 获取错误码
     *
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this -> errorCode;
    }

    /**
     * 设置错误信息
     *
     * @param mixed $errorMsg
     */
    public function setErrorMsg($errorMsg): void
    {
        $this -> errorMsg = $errorMsg;
    }

    /**
     * 获取错误信息
     *
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this -> errorMsg;
    }


    public function setData($data): void
    {
        // 获取当前方法名称
        $this -> data = $data;
    }

    public function getData()
    {
        return $this -> data;
    }

    public function getPageParam($param)
    {
        $param = !empty($param) ? $param : request() -> param();
        $result = ['total' => 0, 'rows' => []];
        $offset = $param['offset'] ?? 0;
        $limit = $param['limit'] ?? 10;
        $sort = $param['sort'] ?? 'id';
        $order = $param['order'] ?? 'desc';
        return [$result, $offset, $limit, $sort, $order];
    }


}