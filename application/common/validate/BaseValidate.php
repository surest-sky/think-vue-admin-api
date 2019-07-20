<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-4-2
 * Time: 下午3:40
 */

namespace app\common\validate;

use app\common\Traits\ApiResponse;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    use ApiResponse;

    public $data = null;

    protected $regex = [
        'mobile' => '^[1][3,4,5,7,8][0-9]{9}$',
        "checkTimeFormat" => "^([0-9]{3}[1-9]|[0-9]{2}[1-9][0-9]{1}|[0-9]{1}[1-9][0-9]{2}|[1-9][0-9]{3})-(((0[13578]|1[02])-(0[1-9]|[12][0-9]|3[01]))|((0[469]|11)-(0[1-9]|[12][0-9]|30))|(02-(0[1-9]|[1][0-9]|2[0-8])))$",
        "ids" => "/([0-9]+){1,}/"
    ];

    /**
     * 基础方法验证函数
     * @return $this
     */
    public function goCheck()
    {
        # 当　data　不存在的时候去自动校验获取到的参数
        if( is_null($this->data) || empty($this->data)) {
            # 获取待验证的参数
            $this->data = Request::param();
        }

        # 进行验证
        if( !$this->check($this->data) ) {
            $this->frobidden($this->getError());
        }

        return $this;
    }

    /**
     * 基础方法场景验证函数
     * @return $this
     */
    public function goSceneCheck($scene)
    {
        # 当　data　不存在的时候去自动校验获取到的参数
        if( is_null($this->data) || empty($this->data)) {
            # 获取待验证的参数
            $this->data = Request::param();
        }

        # 进行验证
        if( !$this->scene($scene)->check($this->data) ) {
            $this->frobidden($this->getError());
        }

        return $this;
    }

    /**
     * 获取验证成功后的数据参数
     */
    public function validatedData()
    {
        # 通过request获取到的参数 和 规则校验中的rule进行对比得出验证后的数据信息
        $keys = array_keys($this->rule);
        $data = [];
        $origin_data = $this->data;
        foreach ($keys as $key) {
            if(isset($origin_data[$key])) {
                if( ($val = $origin_data[$key]) || strlen($origin_data[$key])) {
                    $data[$key] = $val;
                }
            }
        }
        return $data;
    }

    public function getIds($field = 'ids')
    {
        $ids = \request()->param($field);
        preg_match_all("{$this->regex['ids']}", $ids, $matchs);

        $ids = array_map(function ($id){
            return trim(str_replace(',', '', $id));
        }, $matchs[1]);

        return $ids;
    }
}