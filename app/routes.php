<?php

if (App::runningInConsole()) {
	return;
}

// WARNING: you must comment this init route on production
// INIT INIT INIT COMMENT THIS AFTER FIRST USAGE
Route::controller('init', 'InitController');

//route by domain
foreach (Domain::all() as $dcp) {
	Route::group(array(
		'domain' => $dcp['domain'] 
	), function () use($dcp) {
		if (!Cookie::get('domain_hash')) {
			Route::get('/', 'PanelController@dcp');
		}
	});
}

Route::get('/', 'HomeController@showHome');

Route::controller('login', 'LoginController');
Route::get('logout', 'LoginController@getLogout');

Route::controller('register', 'RegisterController');

Route::controller('password', 'PasswordController');

// Start of private routes protected with auth


Route::controller('dashboard', 'DashboardController');

