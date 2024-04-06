<?php

namespace jszsl001\tp6curd\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Init extends Command
{
    protected function configure()
    {
        $this -> setName('curd:init')
            -> setDescription('Generate base code');
    }

    protected function execute(Input $input, Output $output)
    {
        # 复制code下的文件到各自目录
        $code_path = dirname(__DIR__) . '/code/';

        // 如果目录不存在则新建
        if (!is_dir(app() -> getAppPath() . 'common/logic')) {
            mkdir(app() -> getAppPath() . 'common/logic', 0777, true);
        }
        if (!is_dir(app() -> getAppPath() . 'common/model/traits')) {
            mkdir(app() -> getAppPath() . 'common/model/traits', 0777, true);
        }
        if (!is_dir(app() -> getAppPath() . 'common/controller')) {
            mkdir(app() -> getAppPath() . 'common/controller', 0777, true);
        }

        copy($code_path . 'BaseLogic.php', app() -> getAppPath() . 'common/logic/BaseLogic.php');
        copy($code_path . 'CommFunc.php', app() -> getAppPath() . 'common/model/traits/CommFunc.php');
        copy($code_path . 'RestBaseController.php', app() -> getAppPath() . 'common/controller/RestBaseController.php');
        copy($code_path . 'StatusCode.php', app() -> getAppPath() . 'StatusCode.php');

    }


}