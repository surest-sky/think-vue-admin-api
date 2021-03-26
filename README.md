# 该项目已停止维护！！！！

本项目已经不再维护。使用时建议参考同类项目，**推荐使用**如下项目

https://github.com/hardphp/vue-admin

----------------------------

欢迎加入微信群:

![WechatIMG18.jpeg](https://surest.cn/usr/uploads/2021/03/2515408408.jpeg)

以下是原文

## thinkphp-vue-admin 后台接口 |　前后端分离解决方案

> 它一套有thinkphp开发集成性后台接口，内置权限管理，api响应，psysh等多功能工具

推荐一个thinkphp 权限管理包：

[https://github.com/surest-sky/thinkphp-permission](https://github.com/surest-sky/thinkphp-permission)

他的作用

- 自带登录校验
- 快速完成数据格式校验
- 自带权限管理机制
- 支持权限管理自动生成节点
- 自带响应格式处理
- 支持后端的菜单控制

利用它

快速搭建基础的　前后端分离场景下的后台

在线地址: [http://v-web.surest.cn/](http://v-web.surest.cn/)

账号: admin
密码: admin123

vue 地址　: [https://github.com/surest-sky/thinkphp-vue-admin](https://github.com/surest-sky/thinkphp-vue-admin)

### 安装

    git clone https://github.com/surest-sky/think-vue-admin-api.git
    
    cd think-vue-admin-api
    
    composer install
    
    导入 目录下的 `permission.sql`
    
### 初始化权限节点

    php think init_permission --action reset
    
### 有关应用

#### psysh

psysh 是什么: [http://vergil.cn/archives/psysh](http://vergil.cn/archives/psysh)

    > php think psysh
    
      \app\common\Example::psysh();
      
      输出: 2
      
    -> php think psysh
    
        \app\common\Example::init_permission();
        
      输出: 更新节点完成

### 自定义验证器 | validate

具体使用方法不详说, 大概如下
    
定义一个验证器, 继承  `app\common\validate\BaseValidate`
    
验证数据
    
    $validate = (new CircleValidate())->goCheck();
    $data = $validate->validatedData(); # 获取验证通过的数据
    
然后常用的正则和一些方法都可以写到 `BaseValidate` 中即可

例如常用验证 `ids` 格式如 1,2,3,4 的数据可以这样获取
    
    # 校验ids
    $validate = (new IdsValidate())->goCheck();
    $ids = $validate->getIds();
    

### 响应方式

- $this->successed(); 

       {
           "msg": "success",
           "code": 200,
           "data": {}
       }

- $this->internalError();

        {
            "msg": "服务器错误",
            "code": 500,
            "data": {}
        }

- $this->notFond();

        {
            "msg": "未找到",
            "code": 404,
            "data": {}
        }


- $this->frobidden();

            {
                "msg": "未授权",
                "code": 401,
                "data": {}
            }


- $this->failed();

        {
            "msg": "授权失败",
            "code": 403,
            "data": {}
        }
    
在 `BaseController` 中
    
    use ApiResponse;
    
继承  `BaseController`
    
    使用响应的时候, 直接
    
    $this->successed($list);
    
具体的可见方法: [app\common\Traits\ApiResponse](https://github.com/surest-sky/think-vue-admin-api/blob/master/application/common/Traits/ApiResponse.php)

### 异常处理控制
    
在 `app.php` 中, 我们接管了异常, 响应格式替换为我们的 `ApiResponse`

具体见方法, `app\common\exception\Handler`

异常处理控制后, 可定制化异常处理

见: [http://surest.cn/archives/85/](http://surest.cn/archives/85/) 


简单说明一下:

在`handler.php`通过传递当前抛出异常的 `exception` 和我们需要针对化处理的异常进行校验, 采用的也就是 `instanceof` 去判断来自于哪个异常

这样做的好处就是, 针对不用的异常进行监控, 并抛出指定的异常错误信息 或者 **日志** 

自定义的异常处理 必须 继承 `CustomExceptionInterface` 接口, 通过 `showMsg` 来处理抛出异常

代码中, 我们会发现一个问题, 在 `handler.php` 中 异常信息是返回的, 官方文档中有介绍, **使用异常处理接管的函数必须返回一个 `response` 响应, 所以可以看到 在 `BaseException` 中

设置了 `is_anomaly_andling_takeover` 就是告诉 `ApiResponse` 需要返回一个`response`响应



### 交流群

QQ 交流群

735713840

### 我的博客

[http://surest.cn](http://surest.cn)
    


