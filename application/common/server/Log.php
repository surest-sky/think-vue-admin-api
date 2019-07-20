<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-1
 * Time: 下午12:01
 */

namespace app\common\server;


use think\template\driver\File;

class Log
{
    /**
     * 日志界别对应的map
     */
    const level = [
        0 => 'log',   // 普通请求日志级别
        1 => 'error', // 错误级别
        2 => 'notice', // 警告
        3 => 'info',  // 普通信息输出
        4 => 'debug',
        5 => 'seious'// 非常严重
    ];

    private $level; // 错误级别
    private $content; // 错误的详细内容
    private $title; // 错误提示内容
    public $list_key = "d88_logs"; // list 结构缓存key
    public $err_code; // 错误级别
    /**
     * 设置日志级别
     * @param int $level
     * @return $this
     */
    public function setLevel(int $level = 0)
    {
        $this->level = $level;
        return $this;
    }

    public function setTitle($title = null)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * 设置错误消息
     * @param array $content
     */
    public function setContent(array $content)
    {
        $this->content = \json_encode($content);
        $this->write_data();
    }

    /**
     *  写入数据
     */
    public function write_data(){

        try {
            $redis =  redis_connect(3);
            $key = md5(time());
            $data = [
                'content' => $this->content,
                'title' => $this->title,
                'level' => self::level[$this->level],
                'create_time' => time()
            ];

            $redis->hMset($key, $data);
            $redis->lPush($this->list_key, $key);

        }catch (\Exception $e) {
            $msg =  $e->getMessage();
            \think\facade\Log::error("严重异常: {$msg}");
        }
    }

    public static function setException()
    {
        $log = new self();
        return $log;
    }

    /**
     * 把日志数据写入到MySQL中
     */
    public static function redis_to_mysql()
    {
        $redis = redis_connect(3);
        $that = (new static());
        while ($err_keys = $redis->blPop($that->list_key, 5)){
            if(!$err_keys) {
                return;
            }
            foreach ($err_keys as $err_key) {
                $err_info = $redis->hGetAll($err_key);

                if($err_info) {
                    $that->write_mysql($err_info);
                    $redis->del($err_key);
                }
            }

        }
    }

    /**
     * 写入数据库
     * @param $data
     */
    public static function write_mysql($data)
    {
        try {
            \app\common\model\Log::create([
                'title' => $data['title'] ?? '',
                'level' => $data['level'],
                'content' => $data['content'],
                'log_time' => $data['create_time'] ?? time()
            ]);

            self::push_email($data);

        }catch (\Exception $e) {
            $msg =  $e->getMessage();
            \think\facade\Log::error("严重异常: {$msg}");
        }
    }

    /**
     * 推送到邮箱
     */
    public static function push_email($data)
    {
        # 推送到发送邮件给管理员
        if(!$data['level'] == self::level[5] && !$data['level'] == self::level[3] ) {
            return;
        }
        $content = \json_decode($data['content'], true);
        $data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);

        $html = <<<EOT
<h1> {$data['title']}</h1>
    <h3>错误级别: {$data['level']}</h3>
    <h3>请求地址: {$content['path_info']}</h3>
    <h3>请求方法: {$content['method']}</h3>
    <h3>请求ip: {$content['ip']}</h3>
    <h3>错误行: {$content['line'] }</h3>
    <h3>错误内容: {$content['message'] }</h3>
    <h3>错误文件: {$content['file'] }</h3>
    <h3>异常类: {$content['class_'] }</h3>
    <h3>错误时间: {$data['create_time']}</h3>
EOT;

        $emails = config('system.developer');
        $mail = Mail::to($emails)->title("错误预警")->content($html);
        Mailer::setMailer()->send($mail);
    }
}