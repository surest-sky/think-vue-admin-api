<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-5
 * Time: 上午11:57
 */

namespace app\common\server;


use Nette\InvalidArgumentException;
use Nette\Mail\Message;

class Mail extends Message

{

    public $config;

    // [String] e-mail

    protected $from;

    // [Array] e-mail list

    protected $to;

    protected $title;

    protected $body;

    public function __construct($to)
    {
        $host = config('email.username');
        $this->setFrom("{$host}", "D88科技")
            ->setHeader("name", $host);

        if ( is_array($to) ) {

            foreach ($to as $email) {

                $this->addTo($email);

            }

        } else {

            $this->addTo($to);

        }

    }

    public function from($from=null)
    {

        if ( !$from ) {
            throw new InvalidArgumentException("邮件发送地址不能为空！");
        }

        $this->setFrom($from);

        return $this;

    }

    public static function to($to=null)

    {

        if ( !$to ) {

            throw new InvalidArgumentException("邮件接收地址不能为空！");

        }

        return new Mail($to);

    }

    public function title($title=null)

    {

        if ( !$title ) {

            throw new InvalidArgumentException("邮件标题不能为空！");

        }

        $this->setSubject($title);

        return $this;

    }

    public function content($content=null)

    {

        if ( !$content ) {

            throw new InvalidArgumentException("邮件内容不能为空！");

        }

        $this->setHTMLBody($content);
        return $this;
    }

}