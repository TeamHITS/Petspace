<?php

return [
  'gcm' => [
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'My_ApiKey',
  ],
  'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAya7ThHI:APA91bFhvwQg0bi1OMRI5C2sRq1WNZmjD-NWdHSsU2iWQoErceDTl3tTglbKVsBvglNKXwBzj2Y8LnjYu0m7BgclVRmeSSjtoH_Ccyaegcys2epOIL820ZglwtpUAGzq8RATf37B282_',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
      'passPhrase' => '1234', //Optional
      'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
      'dry_run' => true
  ]
];