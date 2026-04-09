<?php

use App\Models\User;
use Livewire\Volt\Component;
use function Livewire\Volt\computed;

$users = computed(fn () => User::orderBy('name')->get());

?>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">👥 User List (from Database)</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($this->users as $user)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($user->role == 'admin') bg-red-100 text-red-800
                                @elseif($user->role == 'manager') bg-blue-100 text-blue-800
                                @elseif($user->role == 'team') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $user->role }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-sm text-gray-500">
            Total users: {{ $this->users->count() }}
        </div>
    </div>
</div>