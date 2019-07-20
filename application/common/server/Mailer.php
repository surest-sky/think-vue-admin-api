<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-16
 * Time: 下午3:35
 */

namespace app\common\server;

use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

/**
 *
 * 使用：
 * $mail = Mail::to($emails)->title("错误预警")->content($html);
 * Mailer::setMailer()->send($mail);
 *
 * Class Mailer
 * @package app\common\server
 */
class Mailer
{
    /**
     * 实例化一个Mailer类
     * @return SmtpMailer
     */
    public static function setMailer()
    {
        $mailer = new SmtpMailer([
            'host' => config('email.host'),
            'username' => config('email.username'),
            'password' => config('email.password'),
            'secure' => config('email.secure')
        ]);
        return $mailer;
    }

    /**
     * 发送
     * @param Message $mail
     */
    public function send(Message $mail)
    {
        $this->send($mail);
    }
}