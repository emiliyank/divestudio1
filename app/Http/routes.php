<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/postChangeLanguage/{language}', 'CommonController@postChangeLanguage');

/* ---Ads--- */
Route::get('/ads', 'AdController@index');
Route::get('/ad', 'AdController@add_form');
Route::post('/ad', 'AdController@add_submit');
Route::get('/ad/{cm_ad}', 'AdController@single_ad');

Route::get('/ads',[
    'as' => 'route.ads_list',
    'uses' => 'AdController@index'
	]);

/* ---Offers--- */
Route::get('/ad_offers/{cm_ad}', 'CmOfferController@ad_offers_list');
Route::get('/offer/{cm_ad}', 'CmOfferController@add_form');
Route::post('/offer', 'CmOfferController@add_submit');
Route::post('/approve_offer/{cm_offer}', 'CmOfferController@approve_offer');

Route::get('/offer-translate/{cm_ad}/{cm_offer}',[
    'as' => 'route.offer_translate',
    'uses' => 'CmOfferController@add_translation_form'
	]);
Route::post('/offer-translate/{cm_offer}',[
    'as' => 'route.offer_translate_submit',
    'uses' => 'CmOfferController@add_translation_submit'
	]);

/* ---Ratings--- */
Route::get('/add-rating/{cm_ad}/{cm_offer}',[
    'as' => 'route.add_rating',
    'uses' => 'CmRatingController@add_form'
    ])->middleware('ratingPrivilleges');
Route::post('/add-rating',[
    'as' => 'route.add_rating',
    'uses' => 'CmRatingController@add_submit'
    ]);


/* --- Static Pages --- */
Route::get('/',[
    'as' => 'route.homepage',
    'uses' => 'StaticPagesController@index'
    ]);