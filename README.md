# 灵感项目后端API接口

灵感项目后端API接口使用Thinkphp5.1版本开发，且保持thinkphp5最新版本；

## 安装

### 安装前置

如果还没有安装 Composer，在 Linux 和 Mac OS X 中可以运行如下命令：
~~~
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
~~~
在 Windows 中，你需要下载并运行 Composer-Setup.exe。
如果遇到任何问题或者想更深入地学习 Composer，请参考 Composer 文档（英文），Composer 中文。

由于众所周知的原因，国外的网站连接速度很慢。因此安装的时间可能会比较长，我们建议通过下面的方式使用国内镜像。

打开命令行窗口（windows用户）或控制台（Linux、Mac 用户）并执行如下命令：
~~~
composer config -g repo.packagist composer https://packagist.phpcomposer.com
~~~
注意：最近phpcomposer镜像存在问题，可以改成
~~~
composer config -g repo.packagist composer https://packagist.laravel-china.org
~~~

### 安装依赖
~~~
composer install
~~~

### 启动服务
~~~
php think run
~~~

然后就可以在浏览器中访问

~~~
http://localhost:8000
~~~

也可以自行配置apache或nginx等web服务器，部署指南参见开发手册

### 更新框架
~~~
composer update topthink/framework
~~~

框架始终保持官方LTS版本（大改动除外）

## 在线手册

+ [完全开发手册](https://www.kancloud.cn/manual/thinkphp5_1/content)
+ [升级指导](https://www.kancloud.cn/manual/thinkphp5_1/354155) 

## 目录结构

目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─api                API模块目录
│  │  ├─common          公共类目录
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─service         业务逻辑目录
│  │  ├─validate        验证器目录
│  │  └─ ...            更多类库目录
│  ├─http               
│  │  └─middleware      中间件目录
│  ├─command.php        命令行定义文件
│  ├─common.php         公共函数文件
│  └─tags.php           应用行为扩展定义文件
│
├─config                应用配置目录
│  ├─app.php            应用配置
│  ├─cache.php          缓存配置
│  ├─cookie.php         Cookie配置
│  ├─database.php       数据库配置
│  ├─log.php            日志配置
│  ├─session.php        Session配置
│  ├─redis.php          Redis配置
│  ├─template.php       模板引擎配置
│  └─trace.php          Trace配置
│
├─route                 路由定义目录
│  ├─route.php          路由定义
│  └─...                更多
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~

> 可以使用php自带webserver快速测试
> 切换到根目录后，启动命令：php think run

## 命名规范

`ThinkPHP5`遵循PSR-2命名规范和PSR-4自动加载规范，并且注意如下规范：

### 目录和文件

*   目录不强制规范，驼峰和小写+下划线模式均支持；
*   类库、函数文件统一以`.php`为后缀；
*   类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；
*   类名和类文件名保持一致，统一采用驼峰法命名（首字母大写）；

### 函数和类、属性命名

*   类的命名采用驼峰法，并且首字母大写，例如 `User`、`UserType`，默认不需要添加后缀，例如`UserController`应该直接命名为`User`；
*   函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 `get_client_ip`；
*   方法的命名使用驼峰法，并且首字母小写，例如 `getUserName`；
*   属性的命名使用驼峰法，并且首字母小写，例如 `tableName`、`instance`；
*   以双下划线“__”打头的函数或方法作为魔法方法，例如 `__call` 和 `__autoload`；

### 常量和配置

*   常量以大写字母和下划线命名，例如 `APP_PATH`和 `THINK_PATH`；
*   配置参数以小写字母和下划线命名，例如 `url_route_on` 和`url_convert`；

### 数据表和字段

*   数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如 `think_user` 表和 `user_name`字段，不建议使用驼峰和中文作为数据表字段命名。

