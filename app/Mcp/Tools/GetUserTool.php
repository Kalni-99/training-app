<?php

namespace App\Mcp\Tools;

use App\Models\User;
use Laravel\Mcp\Tool;
use Laravel\Mcp\Attributes\Tool as ToolAttribute;
use Laravel\Mcp\Attributes\Parameter;

#[ToolAttribute(name: 'get_user', description: 'Get user details by email address')]
class GetUserTool extends Tool
{
    #[Parameter(name: 'email', description: 'User email address', required: true)]
    public function execute(string $email): array
    {
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return ['error' => 'User not found'];
        }
        
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'created_at' => $user->created_at->toDateTimeString(),
        ];
    }
}