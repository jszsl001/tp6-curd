# tp6-curd
一键生成CURD基础代码,适用于thinkphp6框架

## 安装

> composer require jszsl001/tp6-curd

## 配置

> 配置文件位于 `config/curd.php`

### 公共配置

```bash
[
    'db_prefix'=>'' //数据表前缀,没有则留空
]
```

## 例子

### 一键生成curd代码

```shell
# module : 模块名
# db_name : 数据表名
php think curd:make [module] [db_name]
```

### 初始化基础文件

```shell
# 生成基础公共文件
php think curd:init  
```

* [BaseLogic.php](src%2Fcode%2FBaseLogic.php)
* [CommFunc.php](src%2Fcode%2FCommFunc.php)
* [RestBaseController.php](src%2Fcode%2FRestBaseController.php)
* [StatusCode.php](src%2Fcode%2FStatusCode.php)

