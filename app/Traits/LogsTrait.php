<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogsTrait
{
    public function log($message)
    {
        $className = class_basename($this);
        $logFile = storage_path("logs/{$className}.log");
        $logger = Log::build([
            'driver' => 'single',
            'path' => $logFile,
        ]);
        $logger->alert($message);
    }
}