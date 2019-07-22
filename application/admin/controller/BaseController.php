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
}