<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-9
 * Time: 上午10:56
 */

namespace app\admin\controller;

use app\admin\model\Circle as CircleModel;
use app\admin\validate\CircleValidate;
use app\admin\validate\IdsValidate;

/**
 * 圈子管理
 * Class Circle
 * @package app\admin\controller
 */
class Circle extends BaseController
{
    /**
     * 圈子管理
     */
    public function index()
    {
        $pagesize = request()->param('pagesize', 10);
        $page = request()->param('page', 1);;
        $circles = CircleModel::condition()->paginate($pagesize, false, compact('page'));

        $this->successed($circles);
    }

    /**
     * 更新圈子
     */
    public function audit()
    {
        $validate = (new CircleValidate())->goCheck();
        $ids = $validate->getIds();

        try {
            CircleModel::batch_update_status($ids, $validate->validatedData()['status']);
        }catch (\Exception $exception) {
            $this->frobidden("更新状态发生异常");
        }

        $this->successed('', '更新成功');
    }

    /**
     * 更新操作
     * @param $id
     */
    public function update($id)
    {
        $validate = (new CircleValidate())->goCheck();
        $data = $validate->validatedData(); # 获取验证通过的数据

        // something....
    }

    /**
     * 删除圈子
     * @param $id
     */
    public function delete($id)
    {
        if($superstore = CircleModel::find($id)) {
            if($superstore->delete()) {
                $this->successed('', '删除成功');
            }else{
                $this->frobidden('删除异常');
            }
        }else{
            $this->notFond("未找到这个圈子");
        }
    }

    /**
     * 批量上线
     */
    public function batch_online()
    {
        $this->bacthTool(1);
    }

    /**
     * 批量屏蔽
     */
    public function batch_lower()
    {
        $this->bacthTool(2);
    }

    /**
     * 批量删除
     */
    public function batch_delete()
    {
        # 校验ids
        $validate = (new IdsValidate())->goCheck();
        $ids = $validate->getIds();
        if(CircleModel::where('id', 'in', $ids)->delete()) {
            $this->successed([], "删除成功");
        }

        $this->frobidden("删除异常,请联系管理员");
    }


    /**
     * 批量操作
     * @param $status
     */
    public function bacthTool($status)
    {
        # 校验ids
        $validate = (new IdsValidate())->goCheck();
        $ids = $validate->getIds();
        $total = (new CircleModel())->batchUpdateStatus($ids, $status);
        $this->successed(compact('total'), '操作成功');
    }
}