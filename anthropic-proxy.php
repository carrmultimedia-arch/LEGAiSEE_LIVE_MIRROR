<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://www.legaisee.com');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

$API_KEY = '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 '; // only place it lives

$body = file_get_contents('php://input');

$ch = curl_init('https://api.anthropic.com/v1/messages');
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST           => true,
  CURLOPT_POSTFIELDS     => $body,
  CURLOPT_HTTPHEADER     => [
    'Content-Type: application/json',
    'x-api-key: ' . $API_KEY,
    'anthropic-version: 2023-06-01'
  ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpCode);
echo $response;