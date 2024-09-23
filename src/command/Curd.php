<?php

namespace jszsl001\tp6curd\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\helper\Str;

class Curd extends Command
{

    protected $db_prefix;

    protected function configure()
    {

        $this -> db_prefix = config('curd.db_prefix');

        $this -> setName('curd:make')
            -> addArgument('module_name', Argument::REQUIRED, "模块名")
            -> addArgument('table_name', Argument::REQUIRED, "表名")
            -> setDescription('Generate CURD code');
    }

    protected function execute(Input $input, Output $output)
    {
        $moduleName = trim($input -> getArgument('module_name'));
        $tableName = trim($input -> getArgument('table_name'));

        // Generate Controller
        $this -> generateController($moduleName, $tableName);

        // Generate Validator
        $this -> generateValidator($moduleName, $tableName);

        // Generate Model
        $this -> generateModel($moduleName, $tableName);

        // Generate Logic
        $this -> generateLogic($moduleName, $tableName);

        $output -> writeln('Code generated successfully.');
    }


    protected function generateController($moduleName, $tableName)
    {
        $moduleName = Str ::lower($moduleName);
        $controllerName = ucfirst(Str ::studly($tableName));

        // 控制器文件路径
        $controllerFilePath = app_path() . $moduleName . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $controllerName . '.php';
        if (!is_dir(dirname($controllerFilePath))) {
            mkdir(dirname($controllerFilePath), 0755, true);
        }

        // 读取模板文件内容
        $templateFilePath = dirname(__DIR__) . '/tpl/controller.tpl';
        $templateContent = file_get_contents($templateFilePath);

        // 替换模板中的变量
        $content = str_replace('<?php echo "<?php\n"; ?>', '<?php', $templateContent);
        $content = str_replace('{{module}}', $moduleName, $content);
        $content = str_replace('{{controller}}', $controllerName, $content);

        // 将替换后的内容写入控制器文件
        file_put_contents($controllerFilePath, $content);

        // 输出提示信息
        $this -> output -> writeln('Controller generated successfully.');
    }

    protected function generateValidator($moduleName, $tableName)
    {
        $moduleName = Str ::lower($moduleName);
        $validateName = ucfirst(Str ::studly($tableName));
        // 验证器文件路径
        $validateFilePath = app_path() . $moduleName . DIRECTORY_SEPARATOR . 'validate' . DIRECTORY_SEPARATOR . $validateName . 'Validate.php';
        if (!is_dir(dirname($validateFilePath))) {
            mkdir(dirname($validateFilePath), 0755, true);
        }
        // 读取模板文件内容
        $templateFilePath = dirname(__DIR__) . '/tpl/validate.tpl';
        $templateContent = file_get_contents($templateFilePath);
        // 读取数据库所有字段
        $tableColumns = \think\facade\Db ::query("SHOW COLUMNS FROM " . $this -> db_prefix . $tableName);
        // 生成验证规则
        $rules = '';
        foreach ($tableColumns as $column) {
            $columnName = $column['Field'];
            $columnType = $column['Type'];

            // 根据字段类型生成验证规则
            if (strpos($columnType, 'int') !== false) {
                $rules .= "\n        '{$columnName}' => 'require|integer',";
            } elseif (strpos($columnType, 'varchar') !== false) {
                $rules .= "\n        '{$columnName}' => 'require',";
            } elseif (strpos($columnType, 'text') !== false) {
                $rules .= "\n        '{$columnName}' => 'require', ";
            }
        }
        // 生成提示信息
        $message = '';
        foreach ($tableColumns as $column) {
            $columnName = $column['Field'];
            $columnType = $column['Type'];

            // 根据字段类型生成提示信息
            if (strpos($columnType, 'int') !== false) {
                $message .= "\n        '{$columnName}.require' => '{$columnName} 不能为空',";
                $message .= "\n        '{$columnName}.integer' => '{$columnName} 格式错误',";
            } elseif (strpos($columnType, 'varchar') !== false) {
                $message .= "\n        '{$columnName}.require' => '{$columnName} 不能为空',";
            } elseif (strpos($columnType, 'text') !== false) {
                $message .= "\n        '{$columnName}.require' => '{$columnName} 不能为空',";
            }
        }

        // 替换模板中的变量
        $content = str_replace('<?php echo "<?php\n"; ?>', '<?php', $templateContent);
        $content = str_replace('{{module}}', $moduleName, $content);
        $content = str_replace('{{validate}}', $validateName . 'Validate', $content);
        $content = str_replace('{{rule}}', $rules, $content);
        $content = str_replace('{{message}}', $message, $content);

        // 将替换后的内容写入控制器文件
        file_put_contents($validateFilePath, $content);
        // 输出提示信息
        $this -> output -> writeln('Validator generated successfully.');
    }

    protected function generateModel($moduleName, $tableName)
    {
        $moduleName = Str ::lower($moduleName);
        $modelName = ucfirst(Str ::studly($tableName));
        // 验证器文件路径
        $modelFilePath = app_path() . $moduleName . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . $modelName . 'Model.php';
        if (!is_dir(dirname($modelFilePath))) {
            mkdir(dirname($modelFilePath), 0755, true);
        }
        // 读取模板文件内容
        $templateFilePath = dirname(__DIR__) . '/tpl/model.tpl';
        $templateContent = file_get_contents($templateFilePath);

        // 读取数据库所有字段
        $tableColumns = \think\facade\Db ::query("SHOW COLUMNS FROM " . $this -> db_prefix . $tableName);

        // 生成新增字段代码
        $addFields = '';
        foreach ($tableColumns as $column) {
            $columnName = $column['Field'];
            $addFields .= "\n            \$this -> {$columnName} = \$param['{$columnName}']; ";
        }
        // 生成更新字段代码
        $updateFields = '';
        foreach ($tableColumns as $column) {
            $columnName = $column['Field'];
            $updateFields .= "\n            \$info -> {$columnName} = \$param['{$columnName}']; ";
        }

        // 替换模板中的变量
        $content = str_replace('<?php echo "<?php\n"; ?>', '<?php', $templateContent);
        $content = str_replace('{{module}}', $moduleName, $content);
        $content = str_replace('{{model}}', $modelName . 'Model', $content);
        $content = str_replace('{{table}}', $this -> db_prefix . $tableName, $content);
        $content = str_replace('{{add_fields}}', $addFields, $content);
        $content = str_replace('{{add_fields}}', $addFields, $content);
        $content = str_replace('{{update_fields}}', $updateFields, $content);

        // 将替换后的内容写入控制器文件
        file_put_contents($modelFilePath, $content);

        // 输出提示信息
        $this -> output -> writeln('Model generated successfully.');
    }

    protected function generateLogic($moduleName, $tableName)
    {

        $moduleName = Str ::lower($moduleName);
        $logicName = ucfirst(Str ::studly($tableName));
        // 验证器文件路径
        $modelFilePath = app_path() . $moduleName . DIRECTORY_SEPARATOR . 'logic' . DIRECTORY_SEPARATOR . $logicName . 'Logic.php';
        if (!is_dir(dirname($modelFilePath))) {
            mkdir(dirname($modelFilePath), 0755, true);
        }
        // 读取模板文件内容
        $templateFilePath = dirname(__DIR__) . '/tpl/logic.tpl';
        $templateContent = file_get_contents($templateFilePath);

        // 读取数据库所有字段
        $tableColumns = \think\facade\Db ::query("SHOW COLUMNS FROM " . $this -> db_prefix . $tableName);
        // 生成新增字段代码
        $fields = '';
        foreach ($tableColumns as $column) {
            $columnName = $column['Field'];
            $fields .= "{$columnName},";
        }

        // 删除最后的逗号
        $fields = rtrim($fields, ',');

        // 替换模板中的变量
        $content = str_replace('<?php echo "<?php\n"; ?>', '<?php', $templateContent);
        $content = str_replace('{{module}}', $moduleName, $content);
        $content = str_replace('{{logic}}', $logicName, $content);
        $content = str_replace('{{fields}}', $fields, $content);

        // 将替换后的内容写入控制器文件
        file_put_contents($modelFilePath, $content);
        // 输出提示信息
        $this -> output -> writeln('Logic generated successfully.');
    }


}
