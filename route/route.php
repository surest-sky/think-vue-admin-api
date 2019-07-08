<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('hello/:name', 'index/hello');

Route::group('admin', function (){
    Route::get('auth/setPermissions', 'Admin/Auth/setPermissions');

    Route::group('auths', function (){
        Route::resource('permission', 'Admin/Auths.Permission');
        Route::put('role/addPermission', 'Admin/Auths.role/addPermission'); // 添加权限
        Route::resource('role', 'Admin/Auths.role');
    });
});
