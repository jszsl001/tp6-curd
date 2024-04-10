<?php

namespace app\{{module}}\controller;

use app\{{module}}\logic\{{controller}}Logic;
use app\common\controller\RestBaseController;
use app\StatusCode;

class {{controller}} extends RestBaseController
{


    public function create({{controller}}Logic $logic)
    {
        try {
            $param = $this -> request -> post();
            if (false === $logic -> create($param)) {
                return $this -> error($logic -> getErrorCode(), $logic -> getErrorMsg(), $logic -> getData());
            }
            return $this -> success($logic -> getData());
        } catch (\Exception $e) {
            return $this -> error(StatusCode::E_100500[0], $e -> getMessage());
        }
    }

    public function update({{controller}}Logic $logic)
    {
        try {
            $param = $this -> request -> post();
            if (false === $logic -> update($param)) {
                return $this -> error($logic -> getErrorCode(), $logic -> getErrorMsg(), $logic -> getData());
            }
            return $this -> success($logic -> getData());
        } catch (\Exception $e) {
            return $this -> error(StatusCode::E_100500[0], $e -> getMessage());
        }
    }


    public function page({{controller}}Logic $logic)
    {
        try {
            $param = $this -> request -> get();
            if (false === $logic -> page($param)) {
                return $this -> error($logic -> getErrorCode(), $logic -> getErrorMsg(), $logic -> getData());
            }
            return $this -> success($logic -> getData());
        } catch (\Exception $e) {
            return $this -> error(StatusCode::E_100500[0], $e -> getMessage());
        }
    }


    public function detail({{controller}}Logic $logic)
    {
        try {
            $param = $this -> request -> get();
            if (false === $logic -> detail($param)) {
                return $this -> error($logic -> getErrorCode(), $logic -> getErrorMsg(), $logic -> getData());
            }
            return $this -> success($logic -> getData());
        } catch (\Exception $e) {
            return $this -> error(StatusCode::E_100500[0], $e -> getMessage());
        }
    }

    public function delete({{controller}}Logic $logic)
    {
        try {
            $param = $this -> request -> post();
            if (false === $logic -> delete($param)) {
                return $this -> error($logic -> getErrorCode(), $logic -> getErrorMsg(), $logic -> getData());
            }
            return $this -> success($logic -> getData());
        } catch (\Exception $e) {
            return $this -> error(StatusCode::E_100500[0], $e -> getMessage());
        }
    }

    public function enable({{controller}}Logic $logic)
    {
        try {
            $param = $this -> request -> post();
            if (false === $logic -> enable($param)) {
                return $this -> error($logic -> getErrorCode(), $logic -> getErrorMsg(), $logic -> getData());
            }
            return $this -> success($logic -> getData());
        } catch (\Exception $e) {
            return $this -> error(StatusCode::E_100500[0], $e -> getMessage());
        }
    }

    public function disable({{controller}}Logic $logic)
    {
        try {
            $param = $this -> request -> post();
            if (false === $logic -> disable($param)) {
                return $this -> error($logic -> getErrorCode(), $logic -> getErrorMsg(), $logic -> getData());
            }
            return $this -> success($logic -> getData());
        } catch (\Exception $e) {
            return $this -> error(StatusCode::E_100500[0], $e -> getMessage());
        }
    }


}