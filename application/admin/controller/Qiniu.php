<?php

namespace app\admin\controller;

use app\common\Traits\ApiResponse;
use Qiniu\Auth;
use think\Env;
use think\Request;

class Qiniu extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function photo(Request $request)
    {
        $env = new Env();
        $qiniuConfig = config("qiniu.");
        // 用于签名的公钥和私钥
        $accessKey = $qiniuConfig['QINIU_AK'];
        $secretKey = $qiniuConfig['QINIU_SK'];
        $auth = new Auth($accessKey, $secretKey);
        $prefix = $env->get('APP_ENV') ? 'temp/' : '';
        $key = $prefix . 'uploads/' . date('Ymd') . '/' . md5(microtime(true)) . '$(ext)';
        $token = $auth->uploadToken($qiniuConfig['QINIU_BUKET_PATH'], null, 3600, ['saveKey' => $key]);
        $host = $qiniuConfig['QINIU_HOST'];
        $buket = $qiniuConfig['QINIU_BUKET_PATH'];
        $uploadUrl = $qiniuConfig['QINIU_UPLOAD_URL'];

        $this->successed(compact('token', 'host', 'buket', 'uploadUrl'));
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
