<?php
Route::group([
                'namespace' => 'Piripasa\ArticleManager\Controllers',
                'middleware' => ['web'],
            ], function () {
                Route::resource('article', 'ArticleController');
                Route::resource('category', 'CategoryController');
                Route::resource('tag', 'TagController');
            });