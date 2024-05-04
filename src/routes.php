<?php

Route::any('/ckfinder/connector', '\Tungnt\CKEditor\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\Tungnt\CKEditor\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
