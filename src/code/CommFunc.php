<?php
/**
 * @Copyright (c) 2020  XIGU Inc. All rights reserved.
 * @Link https://www.vlcms.com
 * @License江苏溪谷网络科技有限公司版权所有
 * 2022-10-21
 */

namespace app\common\model\traits;

use think\Model;

/**
 * 公共model方法
 *
 * @mixin Model
 */
trait CommFunc
{
    public function getInfoByDeviceId($device_id, string $field = '*', $withTrashed = false)
    {
        $model = new static();
        if ($withTrashed) {
            $model = $model -> withTrashed();
        }
        return $model -> field($field)
            -> where('device_id', '=', $device_id)
            -> findOrEmpty();
    }

    public function getInfoById($id, $field = true, $withTrashed = false)
    {
        return $this -> get_info_by_id($id, $field, $withTrashed);
    }

    public static function getInfoByIdStatic($id, $field = true, $withTrashed = false)
    {
        return self ::get_info_by_id($id, $field, $withTrashed);
    }

    private static function get_info_by_id($id, $field = true, $withTrashed = false)
    {
        $model = new static();
        if ($withTrashed) {
            $model = $model -> withTrashed();
        }
        return $model -> field($field)
            -> where('id', '=', $id)
            -> findOrEmpty();
    }

    /**
     * 条件查询具体值
     *
     * @param array $where
     * @param string $field
     * @param string $default 默认值
     *
     * @return mixed
     * @since 2022-10-27
     */
    public function getFieldByWhere($where, $field, $default = '')
    {
        return $this -> get_field_by_where($where, $field, $default);
    }

    public static function getFieldByWhereStatic($where, $field, $default = '')
    {
        return self ::get_field_by_where($where, $field, $default);
    }

    private static function get_field_by_where($where, $field, $default = '')
    {
        $model = new static();
        return $model -> where($where) -> value($field, $default);
    }

    /**
     * 条件查询具体值
     * User:yyh
     *
     * @param array $where
     * @param string $field
     * @param string $default 默认值
     *
     * @return mixed
     * @since 2022-10-27
     */
    public function getManyFieldByWhere($where, $field, $to_array = true)
    {
        return $this -> get_many_field_by_where($where, $field, $to_array);
    }

    public static function getManyFieldByWhereStatic($where, $field, $to_array = true)
    {
        return self ::get_many_field_by_where($where, $field, $to_array);
    }

    private static function get_many_field_by_where($where, $field, $to_array = true)
    {
        $model = new static();
        $data = $model -> field($field) -> where($where) -> findOrEmpty();
        return $to_array ? $data -> toArray() : $data;
    }

    /**
     * Notes:条件查询具体值 多条数据
     * User: yyh
     * Date: 2022/11/2
     * Time: 16:06
     *
     * @param $where
     * @param $field
     * @param string $default
     *
     * @return float|mixed|string
     */
    public function getListByWhere($where, $field = '*', $primary_key = '')
    {
        $model = new static();
        return $model -> where($where) -> column($field, $primary_key);
    }

    public static function getListByWhereStatic($where, $field = '*', $primary_key = '')
    {
        $model = new static();
        return $model -> where($where) -> column($field, $primary_key);
    }

    public static function getObjListByWhereStatic($where, $field = '*')
    {
        $model = new static();
        return $model -> field($field) -> where($where) -> select();
    }
}
