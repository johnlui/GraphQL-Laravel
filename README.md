# GraphQL-Laravel

### webonyx/graphql-php 的 Laravel 适配，魔改原库，将其彻底融入 Laravel 生命周期，接入 Middleware、Exception、Eloquent，提供 GraphQL 路由、Type、QueryFields 文件结构

<br>

## 用法

### 安装 Composer 包

`composer require johnlui/graphql-laravel`


### 部署开发目录到 app 下

`php artisan vendor:publish`

### 开始工作

> 1. app\GraphApp 为工作文件夹
> 2. Routes.php 为路由文件
> 3. QueryFields 目录存放响应代码
> 4. Types 目录存放自定义类型

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