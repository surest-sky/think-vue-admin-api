<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-5
 * Time: 上午9:17
 */

namespace app\admin\controller;
use app\common\Traits\ApiResponse;
use think\Controller;
use think\Request;

class BaseController extends Controller
{
    use ApiResponse;

    public $user = null;

    public function __construct(Request $request)
    {
        $user = $request->user;
        $this->user = $user;
    }

    //region  跨域header  setHeaders
    /**
     * 跨域 header
     * @param $domainName   跨域地址
     */
    protected  function setHeaders($domainName = false)
    {
//        // 限定式跨域
        if ($domainName) {
            header('Access-Control-Allow-Origin: ' . $domainName); // 可信域
            header('Access-Control-Allow-Credentials: true'); // 存取许可
        } else {
            header('Access-Control-Allow-Origin: *');
        }

        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH');
        header('Access-Control-Max-Age: 3628800');
    }
    //endregion

    //region  获取sessionid
    /**
     * 获取sessionid
     * @param $method  获取的参数
     * 如 POST 中有 session id，那么取出 session；
     * 如果没有，让下面的 session_start 来从 cookie 中获取；
     * 如cookie中也没有，那么建立。
     */
    protected function setSession($method = 'post.')
    {
        $sId = $this->request->param('sid');
        if ($sId) {
            session_id($sId);
        }
        session_start();
    }

    /**
     * 过滤空输入
     * @param $param  要验证的字段
     * @param $msg    要返回的提示信息
     */
    public function checkInput($param, $msg, $istrue=true)
    {
        if (empty($param)) {
            if( $istrue ) {
                $this->ajaxjson(self::error, '参数' . $msg . '的值不能为空！');
            }else{
                $this->ajaxjson(self::error, $msg);
            }
        }
    }
}