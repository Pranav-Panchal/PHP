<?php
require 'vendor/autoload.php';
 
use App\AppLogger;
 
$logger = new AppLogger();

 
// Test different log levels
$logger->logInfo('This is an info message');
$logger->logError('This is an error message');