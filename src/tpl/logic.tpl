<?php

namespace app\{{module}}\logic;

use app\api\validate\{{logic}}Validate;
use app\common\logic\BaseLogic;
use app\StatusCode;
use app\{{module}}\model\{{logic}}Model;

class {{logic}}Logic extends BaseLogic
{

    public function create($param)
    {
        $validate = new {{logic}}Validate();
        if (false === $validate -> scene('create') -> check($param)) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg($validate -> getError());
            return false;
        }

        $model = new {{logic}}Model();
        $result = $model -> add($param);
        if (false === $result) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg('创建失败');
            return false;
        }

        return true;
    }


    public function update($param)
    {
        $validate = new {{logic}}Validate();
        if (false === $validate -> scene('update') -> check($param)) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg($validate -> getError());
            return false;
        }

        $model = new {{logic}}Model();
        $result = $model -> edit($param);
        if (false === $result) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg('更新失败');
            return false;
        }

        return true;
    }


    public function page($param)
    {
        list($result, $offset, $limit, $sort, $order) = $this -> getPageParam($param);
        $model = new {{logic}}Model();
        $field = "{{fields}}";
        $model = $model -> field($field);
        $result['total'] = $model -> count();
        if ($result['total'] == 0) {
            $this -> setData($result);
            return true;
        }
        $data = $model -> order($sort, $order) -> limit($offset, $limit) -> select();
        $result['rows'] = $data;
        $this -> setData($result);
        return true;
    }


    public function detail($param)
    {
        $validate = new {{logic}}Validate();
        if (false === $validate -> scene('id') -> check($param)) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg($validate -> getError());
            return false;
        }

        $model = new {{logic}}Model();
        $info = $model -> getInfoById($param['id']);
        if ($info -> isEmpty()) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg('数据不存在');
            return false;
        }

        $this -> setData($info);
        return true;
    }


    public function delete($param)
    {
        $validate = new {{logic}}Validate();
        if (false === $validate -> scene('id') -> check($param)) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg($validate -> getError());
            return false;
        }
        $model = new {{logic}}Model();
        $info = $model -> getInfoById($param['id']);
        if ($info -> isEmpty()) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg('数据不存在');
            return false;
        }

        $info -> delete();
        return true;
    }

    public function enable($param)
    {
        $validate = new {{logic}}Validate();
        if (false === $validate -> scene('id') -> check($param)) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg($validate -> getError());
            return false;
        }
        $model = new {{logic}}Model();
        $info = $model -> getInfoById($param['id']);
        if ($info -> isEmpty()) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg('数据不存在');
            return false;
        }
        $info -> status = 1;
        $info -> save();
        return true;
    }


    public function disable($param)
    {
        $validate = new {{logic}}Validate();
        if (false === $validate -> scene('id') -> check($param)) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg($validate -> getError());
            return false;
        }
        $model = new {{logic}}Model();
        $info = $model -> getInfoById($param['id']);
        if ($info -> isEmpty()) {
            $this -> setError(StatusCode::E_200000);
            $this -> setErrorMsg('数据不存在');
            return false;
        }
        $info -> status = 0;
        $info -> save();
        return true;
    }



}