<?php

namespace app\admin\controller;

use Qiniu\Auth;
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
        $type = $request->param('type', 'photo');

        if (!in_array($type,['banner','user','photo']))
        {
            $this->frobidden('类型错误');
        }

        $auth = new Auth(\config('qiniu.'.$type.'.AK'),\config('qiniu.'.$type.'.SK'));

        // 生成上传Token
        $token = $auth->uploadToken(\config('qiniu.'.$type.'.bucket'));

        $this->successed(compact('token'));
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
