<?php

namespace app\common\Traits;

use think\exception\HttpResponseException;
use think\response\Json as JsonResponse;

Trait ApiResponse
{
    /**
     * @var int
     */
    public $code = 200;

    # 此处的是为了异常处理接管使用而设置 , 异常处理接管必须返回的是一个response, 所以使用当前参数进行校验使用
    # 判断是否是异常处理接管
    public $is_anomaly_andling_takeover = false;
    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->code;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->code = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        $type = request()->isAjax() ? 'json' : "html";

        $response = JsonResponse::create($data, $type, $this->code, $header);

        // 由于异常处理需要返回的是一个response
        if( $this->is_anomaly_andling_takeover ) {
            return $response; # response
        }

        # 此处是为了判断是否需要进行开启输出 trace
        if(config('app.app_trace')) {
            echo \json_encode($data);
        }else {
            throw new HttpResponseException($response);
        }
    }

    /**
     * @param $status
     * @param array $data
     * @param null $code
     * @return mixed
     */
    public function status($msg, array $data, $code = null, $errcode = null)
    {
        if ($code) {
            $this->setStatusCode(200);
        }

        $status = [
            'msg' => $msg,
            'code' => $errcode ?? ''
        ];

        $data = array_merge($status, $data);

        if( $this->is_anomaly_andling_takeover ) {
            return $this->respond($data);
        }

        $this->respond($data);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function internalError($message = "服务器错误", $errcode = 500)
    {
        $this->status($message, [], 500, $errcode);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function created($message = "创建成功")
    {
        $this->status($message, [], 201);
    }

    /**
     * 获取成功调用的方法
     * @param $data
     * @param string $status
     * @return mixed
     */
    public function successed($data = [], $message = "success")
    {
        $this->status($message, compact('data'), 200, 200);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function notFond($message = '未找到')
    {
        $this->status($message, [], 403, 404);
    }

    public function frobidden($message = '未授权', $errcode = 401, $code = 401)
    {
        $this->status($message, [], $code, $errcode);
    }

    public function failed($message = '授权失败', $errcode = 403, $code = 403)
    {
        $this->status($message, [], $code, $errcode);
    }
}
