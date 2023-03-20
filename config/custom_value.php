<?php

return [
   'CITIZEN_TYPE' => [
      "(N)",
      "(E)",
      "(P)",
      "(T)",
      "(Y)",
      "(S)"
   ],
   'related_product_limit' => env('RELATED_PRODUCT_LIMIT', 8),
   'application' => [
      'android' => [
         'name' => env('ANDROID_APP_NAME', 'MyanSan App'),
         'url' => env('ANDROID_APP_URL', 'https://play.google.com/store/apps')
      ],
      'ios' => [
         'name' => env('IOS_APP_NAME', 'MyanSan App'),
         'url' => env('IOS_APP_URL', 'https://www.apple.com/store')
      ]
   ],
   'delivery_types' => [
      'Normal',
      'Premium',
   ]
];
