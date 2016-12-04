<?php

return [
	'store' => [
		'myStore' => [
			'merchantId' => env('MERCHANT_ID', null),
			'marketplaceId' => env('MARKETPLACE_ID', 'A1VC38T7YXB528'),
			'keyId' => env('AWS_ACCESS_KEY_ID', null),
			'secretKey' => env('AWS_SECRET_ACCESS_KEY', null),
			'amazonServiceUrl' => 'https://mws.amazonservices.jp/',
		]
	],

	// Default service URL
	'AMAZON_SERVICE_URL' => 'https://mws.amazonservices.com/',

	'muteLog' => false
];
