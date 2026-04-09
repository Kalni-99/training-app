<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardChart extends Component
{
    // Line & Area Chart Data
    public array $trendData = [
        ['date' => 'Jan', 'visitors' => 1200, 'revenue' => 4500],
        ['date' => 'Feb', 'visitors' => 1350, 'revenue' => 5200],
        ['date' => 'Mar', 'visitors' => 1100, 'revenue' => 4100],
        ['date' => 'Apr', 'visitors' => 1500, 'revenue' => 6300],
        ['date' => 'May', 'visitors' => 1680, 'revenue' => 7100],
        ['date' => 'Jun', 'visitors' => 1900, 'revenue' => 8500],
    ];

    // Grouped Bar Chart Data
    public array $browserData = [
        ['year' => '2024', 'chrome' => 65, 'firefox' => 18, 'safari' => 17],
        ['year' => '2025', 'chrome' => 63, 'firefox' => 16, 'safari' => 21],
        ['year' => '2026', 'chrome' => 60, 'firefox' => 15, 'safari' => 25],
    ];

    // Stacked Bar Chart Data
    public array $orderData = [
        ['month' => 'January', 'online' => 120, 'retail' => 80, 'wholesale' => 40],
        ['month' => 'February', 'online' => 135, 'retail' => 75, 'wholesale' => 45],
        ['month' => 'March', 'online' => 110, 'retail' => 90, 'wholesale' => 50],
        ['month' => 'April', 'online' => 150, 'retail' => 85, 'wholesale' => 55],
    ];

    public function render()
    {
        return view('livewire.dashboard-chart');
    }
}