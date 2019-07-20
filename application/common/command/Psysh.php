<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-4-3
 * Time: 下午3:47
 */

namespace app\common\command;

use Psy\Shell;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class Psysh extends Command
{
    protected function configure()
    {
        $this->setName('psysh')
             ->setDescription('集成的psysh命令行工具');
    }

    protected function execute(Input $input, Output $output)
    {
        $sh = new Shell();
        $sh->run();
    }
}