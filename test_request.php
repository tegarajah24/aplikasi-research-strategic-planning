<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/bidang', 'GET');
$response = $app->handleRequest($request);

echo "Status: " . $response->getStatusCode() . "\n";
$content = $response->getContent();
echo "Content length: " . strlen($content) . "\n";
if (strlen($content) < 500) {
    echo "Content:\n" . $content . "\n";
} else {
    echo "First 500 chars:\n" . substr($content, 0, 500) . "\n";
}
