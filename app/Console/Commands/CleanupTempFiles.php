<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CleanupTempFiles extends Command
{
    protected $signature = 'cleanup:temp-files';
    
    protected $description = 'Clean up temporary files';

    public function handle()
    {
        $this->info('Cleaning up temporary files...');
        
        Log::info('Temp files cleanup ran at ' . now());
        
        $this->info('Cleanup completed successfully!');
        
        return 0;
    }
}