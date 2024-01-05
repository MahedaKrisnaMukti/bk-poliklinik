<?php

return [
  'access_key_id' => env('AWS_ACCESS_KEY_ID'),
  'bucket' => env('AWS_BUCKET'),
  'default_region' => env('AWS_DEFAULT_REGION'),
  'endpoint' => env('AWS_ENDPOINT'),
  'root' => env('AWS_ROOT'),
  'secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
  'url' => env('AWS_ENDPOINT') . env('AWS_BUCKET') . '/' . env('AWS_ROOT'),
];
