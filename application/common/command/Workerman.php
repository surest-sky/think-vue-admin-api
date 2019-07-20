<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-24
 * Time: 下午3:59
 */

namespace app\common\command;


namespace app\common\command;
use app\common\server\Events;
use GatewayWorker\BusinessWorker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use Workerman\Worker;

/**
 * 来源: http://www.thinkphp.cn/topic/57502.html
 * Class Workerman
 * @package app\common\command
 */
class Workerman extends Command
{
    protected function configure()
    {
        $this->setName('workerman')
            ->addArgument('action', Argument::OPTIONAL, "action  start|stop|restart")
            ->addArgument('type', Argument::OPTIONAL, "d -d")
            ->setDescription('workman启动');
    }

    protected function execute(Input $input, Output $output)
    {
        global $argv;
        $action = trim($input->getArgument('action'));
        $type   = trim($input->getArgument('type')) ? '-d' : '';

        $argv[0] = 'chat';
        $argv[1] = $action;
        $argv[2] = $type ? '-d' : '';
        $this->start();
    }
    private function start()
    {
        $this->startGateWay();
        $this->startBusinessWorker();
        $this->startRegister();
        Worker::runAll();
    }

    private function startBusinessWorker()
    {
        $worker                  = new BusinessWorker();
        $worker->name            = 'BusinessWorker';
        $worker->count           = 1;
        $worker->registerAddress = '127.0.0.1:1236';
        $worker->eventHandler    = Events::class;
    }

    private function startGateWay()
    {
        $gateway = new Gateway("websocket://0.0.0.0:8282");
        $gateway->name                 = 'Gateway';
        $gateway->count                = 1;
        $gateway->lanIp                = '127.0.0.1';
        $gateway->startPort            = 2300;
        $gateway->pingInterval         = 30;
        $gateway->pingNotResponseLimit = 0;
        $gateway->pingData             = '{"type":"@heart@"}';
        $gateway->registerAddress      = '127.0.0.1:1236';
    }

    private function startRegister()
    {
        new Register('text://0.0.0.0:1236');
    }
}