<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Welcome, {{ auth()->user()->name }}!</h3>
                            <p class="mt-1 text-gray-700">Your role:
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                    {{ auth()->user()->role }}
                                </span>
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Member since</p>
                            <p class="text-sm font-medium text-gray-700">
                                {{ auth()->user()->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Test Controls Card - ALL THREE BUTTONS VISIBLE -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <p class="text-red-600 font-bold">Flux button exists: {{ view()->exists('flux::button') ? 'YES' : 'NO' }}</p>
                    <!-- Debug: Check if Flux button exists -->
                    @php
                        var_dump(view()->exists('flux::button'));
                    @endphp

                    <h4 class="text-lg font-semibold mb-4 text-gray-900">Test Controls</h4>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                            Click to Test
                        </button>
                        <button
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                            Success Test
                        </button>
                        <button
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                            Danger Test
                        </button>
                    </div>

                    <flux:button variant="primary" class="mt-4">Test Flux Button</flux:button>
                </div>
            </div>

            <!-- Chart Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <livewire:dashboard-chart />
                </div>
            </div>


            <!-- Volt Counter Component -->
            <div class="mb-6">
                <livewire:counter />
            </div>

            <!-- User List Component -->
            <div class="mb-6">
                <livewire:user-list />
            </div>

            <!-- Status Card - HIGHLY VISIBLE -->
            <div class="bg-green-50 border border-green-200 rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-600 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-800">✓ You're logged in and authenticated</p>
                            <p class="text-sm text-green-700">Your session is active and secure</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>