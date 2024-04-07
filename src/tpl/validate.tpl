<?php

namespace app\{{module}}\validate;

use think\Validate;

class {{validate}} extends Validate
{

    protected $rule = [
        {{rule}}
    ];

    protected $message = [
        {{message}}
    ];


    public function sceneId()
    {
        return $this -> only(['id']);
    }

    public function sceneCreate()
    {
        // TODO
        return $this -> only();
    }

    public function sceneUpdate()
    {
        // TODO
        return $this -> only();
    }



}