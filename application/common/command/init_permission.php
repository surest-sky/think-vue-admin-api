<?php

namespace app\common\command;

use app\admin\model\Permission;
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

class init_permission extends Command
{
    protected function configure()
    {
        # 指令配置
        $this->setName('init_permission')
             ->addOption('action', null, Option::VALUE_REQUIRED, 'update 更新节点 reset 重建节点')
             ->setDescription("初始化权限节点");
        
    }

    protected function execute(Input $input, Output $output)
    {
        if ($input->hasOption('action')) {
            $action= $input->getOption('action');
        } else {
            $action = '';
        }
        $title = ( $action == "reset" ? "重置" : "更新" );

        $output->writeln("开始执行初始化权限节点 , 进行 $title 操作...." . PHP_EOL);

        $is_delete = $action == "reset" ? 1 : 0;

        # 初始化权限节点
    	Permission::init_($is_delete);
    	$output->writeln('执行完成....');
    }
}
