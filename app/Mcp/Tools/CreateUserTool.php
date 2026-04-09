<?php

namespace App\Mcp\Tools;

use App\Models\User;
use Laravel\Mcp\Tool;
use Laravel\Mcp\Attributes\Tool as ToolAttribute;
use Laravel\Mcp\Attributes\Parameter;

#[ToolAttribute(name: 'create_user', description: 'Create a new user account')]
class CreateUserTool extends Tool
{
    #[Parameter(name: 'name', description: 'User full name', required: true)]
    #[Parameter(name: 'email', description: 'User email address', required: true)]
    #[Parameter(name: 'role', description: 'User role (admin, manager, team, user)', required: false)]
    public function execute(string $name, string $email, string $role = 'user'): array
    {
        // Check if user already exists
        $existing = User::where('email', $email)->first();
        if ($existing) {
            return ['error' => 'User with this email already exists'];
        }
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('password123'),
            'role' => $role,
        ]);
        
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'message' => 'User created successfully. Default password: password123',
        ];
    }
}