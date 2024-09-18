<?php

use App\Console\Commands\AutoPayments\RunAutoPaymentsCommand;
use Illuminate\Support\Facades\Schedule;


Schedule::command(RunAutoPaymentsCommand::class)
    ->everyMinute()
    ->onOneServer();