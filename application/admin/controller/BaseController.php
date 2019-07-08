<?php
/**
 * TypechoQiNiu
 * @package TypechoQiNiu
 * @author 邓尘锋
 * @version v1.0.0
 * Date: 2019/6/29
 * Time: 20:05
 */

namespace app\admin\controller;

use app\common\Traits\ApiResponse;
use think\Controller;

class BaseController extends Controller
{
    use ApiResponse;

    protected $field = ['*'];
    protected $modelInstance;

    public function __construct()
    {
        if(isset($this->model)) {
            $this->modelInstance = new $this->model;
        }
    }
    
    public function read($id)
    {
        if(!$model = $this->modelInstance->find($id)) {
            $this->notFond("数据不存在");
        }
        $this->successed($model);
    }

    public function delete($id)
    {
        if(!$model = $this->modelInstance->find($id)) {
            $this->notFond("数据不存在");
        }

        $model->delete();

        $this->successed("删除成功");
    }
}