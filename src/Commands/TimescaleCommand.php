<?php

namespace Taecontrol\Timescale\Commands;

use Illuminate\Console\Command;

class TimescaleCommand extends Command
{
    public $signature = 'timescale';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
