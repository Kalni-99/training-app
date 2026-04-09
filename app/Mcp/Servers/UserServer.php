<?php

namespace App\Mcp\Servers;

use Laravel\Mcp\Server;
use Laravel\Mcp\Attributes\Server as ServerAttribute;
use App\Mcp\Tools\GetUserTool;
use App\Mcp\Tools\CreateUserTool;

#[ServerAttribute(name: 'user-server', description: 'User management server for AI agents')]
class UserServer extends Server
{
    protected array $tools = [
        GetUserTool::class,
        CreateUserTool::class,
    ];
}