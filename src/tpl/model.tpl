<?php

namespace app\{{module}}\model;

use app\common\model\traits\CommFunc;
use think\Model;
use think\model\concern\SoftDelete;

class {{model}} extends Model
{

    use CommFunc,SoftDelete;

    protected $table = '{{table}}';
    protected $autoWriteTimestamp = true;
    protected $defaultSoftDelete = 0;


    public function add($param)
    {
        try {
            {{add_fields}}
            $result = $this -> save();
            if (false === $result) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    public function edit($param)
    {
        try {
            $info = $this -> getInfoById($param['id']);
            if ($info -> isEmpty()) {
                return false;
            }
            {{update_fields}}
            $result = $info -> save();
            if (false === $result) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }



}