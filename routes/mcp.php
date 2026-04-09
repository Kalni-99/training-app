<?php

use Illuminate\Support\Facades\Route;
use Laravel\Mcp\Facades\Mcp;

Route::mcp('/mcp', function () {
    Mcp::server('user-server');
});