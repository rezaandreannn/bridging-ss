<?php

return [
	'api' => [
		'endpoint'  => env('API_BPJS_VCLAIM', 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest/'),
		'consid'  => env('CONS_ID', '7749'),
		'secretkey' => env('SECRET_KEY', '7hEF4A8987'),
		'userkey' => env('USER_KEY_VCLAIM', '766ea39f78ae41ee1a3bd95cd1b75d39'),
	]
];
