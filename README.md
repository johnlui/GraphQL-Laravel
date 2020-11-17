<p align="center">
    <a href="https://github.com/johnlui/GraphQL-Laravel"><img src="https://github.com/johnlui/GraphQL-Laravel/blob/master/assets/GraphQL-Laravel.png"></a>
</p>

<p align="center">
  <a href="https://packagist.org/packages/johnlui/GraphQL-Laravel"><img src="https://poser.pugx.org/johnlui/GraphQL-Laravel/v/stable" alt="GitHub version" height="18"></a>
  <!-- <a href="https://github.com/Pinatra/Pinatra"><img src="https://img.shields.io/badge/Code_Coverage-100%25-brightgreen.svg" alt="code-coverage"></a> -->
  <a href="https://github.com/Pinatra/Pinatra"><img src="https://img.shields.io/badge/PHP-7.1%2B-orange.svg" alt="php-version"></a>
  <a href="https://packagist.org/packages/johnlui/GraphQL-Laravel"><img src="https://poser.pugx.org/johnlui/GraphQL-Laravel/license.svg" alt="License"></a>
</p>
<p align="center">
  <a href="https://travis-ci.org/johnlui/GraphQL-Laravel"><img src="https://travis-ci.org/johnlui/GraphQL-Laravel.svg?branch=master"></a>
</p>

<br>

[`webonyx/graphql-php`](https://github.com/webonyx/graphql-php) 的 Laravel 适配，魔改原库，将其彻底融入 Laravel 生命周期。

## 功能

1. 接入 Laravel Middleware
2. 依赖 Laravel Exception 处理异常流程
3. 完美接入 Eloquent
4. 提供 GraphQL 路由
5. 设置 Types 文件夹，提供强大的 Type 基类
6. 设置 QueryFields 文件夹


<br>

## 用法

### 安装 Composer 包

`composer require johnlui/graphql-laravel`


### 部署开发目录及配置文件到 app 下

`php artisan vendor:publish`

### 快速入门

> 1. `app\GraphApp` 为工作文件夹
> 2. `Routes.php` 为路由文件
> 3. `QueryFields` 目录存放响应代码
> 4. `Types` 目录存放自定义类型
> 5. `config/graphql.php` 为配置文件

## demo

#### query：

```graphql
query ($id: Int) {
  foo(id: $id) {
    id
    foo
    bar
  }
}
```

#### variables:

此处为 JSON 格式描述，开发时应使用 key-value 形式描述 variables，不应该使用 JSON 字符串。

```json
{
  "id": 200
}
```

#### 启动 server

`php artisan serve`

#### url

`http://127.0.0.1:8000/graphql`

修改默认路径请编辑`config/graphql.php`中的`apiUri`。

#### curl raw 代码描述

```bash
curl --location --request POST 'http://127.0.0.1:8000/graphql' \
--header 'Content-Type: application/json' \
--data-raw '{"query":"query($id: Int) {\n    foo(id: $id) {\n        id\n        foo\n        bar\n    }\n}","variables":{"id":200}}'
```

#### 返回值

```json
{
  "status": 0,
  "message": "OK",
  "values": {
    "foo": {
      "id": 200,
      "foo": "foo",
      "bar": "bar"
    },
    "queries": []
  }
}
```

## License

The `johnlui/GraphQL-Laravel` is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)