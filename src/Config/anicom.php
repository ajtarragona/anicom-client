<?php

return [
	
	'debug' => env('ANICOM_DEBUG',false),
	'environment' => env('ANICOM_ENVIRONMENT','pre'),
	'environments'=>[
		'pro'=>[
			"ws_url" => env('ANICOM_URL_PRO','***'),
			"ws_user" => env('ANICOM_USER_PRO',"***"),
			"ws_pwd" => env('ANICOM_PASSWORD_PRO',"***"),
			"id_registre" => env('ANICOM_ID_REGISTRO_PRO',"***"),
			"id_aplicacio" => env('ANICOM_ID_APLICACIO_PRO',"ANICOM"),
		],
		'pre'=>[
			"ws_url" => env('ANICOM_URL_PRE','***'),
			"ws_user" => env('ANICOM_USER_PRE',"***"),
			"ws_pwd" => env('ANICOM_PASSWORD_PRE',"***"),
			"id_registre" => env('ANICOM_ID_REGISTRO_PRE',"***"),
			"id_aplicacio" => env('ANICOM_ID_APLICACIO_PRE',"ANICOM"),
		]
	],
];

