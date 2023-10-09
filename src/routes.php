<?php

Route::group(['prefix' => 'ajtarragona/anicom','middleware' => ['anicom-backend','web','auth','language']	], function () {
	Route::get('/', 'Ajtarragona\Anicom\Controllers\AnicomBackendController@home')->name('anicom.home');
	
});
