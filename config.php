<?php
declare(strict_types=1);
/* Set these values in your hosting control panel before running /install.php. */
$config = [
    'db_host' => 'localhost',
    'db_name' => 'fitzeno_db',
    'db_user' => 'fitzeno_user',
    'db_pass' => 'CHANGE_THIS_DATABASE_PASSWORD',
    'site_url' => '', // Leave blank for automatic localhost-folder and live-domain detection.
];
$host = strtolower((string)($_SERVER['HTTP_HOST'] ?? ''));
if ($host === 'localhost' || str_starts_with($host, 'localhost:') || str_starts_with($host, '127.0.0.1:') || $host === '127.0.0.1') {
    $config['db_user'] = 'root';
    $config['db_pass'] = '';
}
return $config;
