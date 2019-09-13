<?php
/**
 * author: NanQi
 * datetime: 2019/5/7 18:30
 */
namespace app\framework;

use GO\Scheduler;

class Schedule {
    public function run()
    {
        $scheduler = new Scheduler();

        $scheduler
            ->call(function() {
                file_put_contents('nanqi.log', date('Y-m-d H:i:s'), FILE_APPEND);
            })
            ->hourly();

        $scheduler->run();
    } 
}