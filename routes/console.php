<?php

use App\Console\Commands\AutoPayments\AutoPaymentsCommand;
use Illuminate\Support\Facades\Schedule;


Schedule::command(AutoPaymentsCommand::class)
    ->everyMinute()
    ->onOneServer();