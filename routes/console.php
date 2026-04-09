<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

// Heartbeat - runs every minute
Schedule::call(function () {
    Log::info('Scheduler heartbeat at ' . now());
})->everyMinute();

// Cleanup command - runs hourly
Schedule::command('cleanup:temp-files')->hourly();