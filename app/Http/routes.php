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
Route::post('/article-rating',[
    'as' => 'route.article_rating',
    'uses' => 'CmRatingController@submit_article_rating'
    ])->middleware('auth');

/* --- User Profile --- */
Route::get('/user-profile',[
    'as' => 'route.user_profile',
    'uses' => 'UserController@user_profile'
    ]);
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

Route::get('/ads_list', 'UserController@ads_list_ver'); //Кратък списък
Route::get('/ads-list', 'UserController@ads_list');

/* --- Static Pages --- */
Route::get('/',[
    'as' => 'route.homepage',
    'uses' => 'StaticPagesController@index'
    ]);
Route::get('/list-static-pages',[
    'as' => 'route.list_static_pages',
    'uses' => 'StaticPagesController@list_static_pages'
    ])->middleware('auth');
Route::get('/add-static-page',[
    'as' => 'route.add_static_page',
    'uses' => 'StaticPagesController@add_static_page'
    ])->middleware('auth');
Route::post('/add-static-page',[
    'as' => 'route.add_static_page_submit',
    'uses' => 'StaticPagesController@add_static_page_submit'
    ])->middleware('auth');
Route::get('/static-page/{cm_static_page}',[
    'as' => 'route.cm_static_page_id',
    'uses' => 'StaticPagesController@static_page'
    ]);
Route::get('/delete-static-page/{cm_static_page}',[
    'as' => 'route.delete_static_page',
    'uses' => 'StaticPagesController@delete_static_page'
    ])->middleware('auth');
Route::get('/edit-static-page/{cm_static_page}',[
    'as' => 'route.edit_static_page',
    'uses' => 'StaticPagesController@edit_static_page'
    ])->middleware('auth');
Route::post('/edit-static-page',[
    'as' => 'route.edit_static_page_submit',
    'uses' => 'StaticPagesController@edit_static_page_submit'
    ])->middleware('auth');
Route::post('/approve-static-page',[
    'as' => 'route.approve_static_page_submit',
    'uses' => 'StaticPagesController@approve_static_page_submit'
    ])->middleware('auth');

Route::get('/about-roles',[
    'as' => 'route.about_roles',
    'uses' => 'StaticPagesController@about_roles'
    ]);
Route::get('/terms-and-conditions',[
    'as' => 'route.terms_and_conditions',
    'uses' => 'StaticPagesController@terms_and_conditions'
    ]);
Route::get('/faq',[
    'as' => 'route.faq',
    'uses' => 'StaticPagesController@faq'
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
Route::get('/articles',[
    'as' => 'route.articles_list',
    'uses' => 'CmArticleController@articles_list'
    ]);
Route::get('/pending-articles',[
    'as' => 'route.pending_articles',
    'uses' => 'CmArticleController@pending_articles'
    ])->middleware('auth');

/* ---Contacts--- */
Route::get('/contact', 'ContactController@index');
Route::get('/contacts-list', 'ContactController@contacts_list');
Route::post('/contact-status', 'ContactController@contacts_status');

Route::post('/contact', 'ContactController@add_submit');
Route::get('/contact/ok', function(){ return View::make("contacts.ok"); });
Route::post('/contact/ok', function(){ return redirect('/'); });

