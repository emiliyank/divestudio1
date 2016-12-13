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

Route::get('/show_ad/{cm_ad}', 'AdController@show_ad');

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

/* --- User Profile --- */
Route::get('/user-details',[
    'as' => 'route.edit_user_details',
    'uses' => 'UserController@edit_user_details_form'
    ]);
Route::post('/user-details',[
    'as' => 'route.edit_user_details_submit',
    'uses' => 'UserController@edit_user_details_submit'
    ]);

Route::get('/account',[
    'as' => 'route.edit_account_info',
    'uses' => 'UserController@edit_account_info_form'
    ]);
Route::post('/account',[
    'as' => 'route.edit_account_info_submit',
    'uses' => 'UserController@edit_account_submit'
    ]);

Route::get('/ads_list', 'UserController@ads_list');

/* --- Static Pages --- */
Route::get('/',[
    'as' => 'route.homepage',
    'uses' => 'StaticPagesController@index'
    ]);

/* ---Articles--- */
Route::get('/add-article',[
    'as' => 'route.add_article',
    'uses' => 'CmArticleController@add_form'
    ])->middleware('auth');
Route::post('/add-article',[
    'as' => 'route.add_article',
    'uses' => 'CmArticleController@add_submit'
    ])->middleware('auth');
Route::get('/user-articles',[
    'as' => 'route.user_articles',
    'uses' => 'CmArticleController@user_articles'
    ])->middleware('auth');
Route::get('/single-article/{cm_article}',[
    'as' => 'route.single_article',
    'uses' => 'CmArticleController@single_article'
    ]);
Route::post('/approve-article',[
    'as' => 'route.approve_article',
    'uses' => 'CmArticleController@approve_article'
    ])->middleware('auth');

/* ---Contacts--- */
Route::get('/contact', 'ContactController@index');

Route::get('/articles',[
    'as' => 'route.articles_list',
    'uses' => 'CmArticleController@articles_list'
    ]);

Route::post('/contact', 'ContactController@add_submit');
Route::get('/contact/ok', function(){ return View::make("contacts.ok"); });
Route::post('/contact/ok', function(){ return redirect('/'); });

