<?php

Route::group([
    /*'domain' => env('APP_REGION_URL', '{region}.villato.waxdt.com'),*/
    /* 'domain' => '192.168.1.129', */
    'as' => 'region.',
], function () {
    Route::get('/', [
        'as' => 'detail',
        'uses' => 'RegionController@getRegionDetail',
    ]);

    Route::get('plaatsen', [
        'as' => 'index',
        'uses' => 'RegionController@getRegionDetail',
    ]);

    Route::get('categorie-{category}', [
        'as' => 'category.detail',
        'uses' => 'CategoryController@getCategoryDetail',
    ]);

    Route::get('vacatures', [
        'as' => 'vacancy.index',
        'uses' => 'VacancyController@getRegionVacancyIndex',
    ]);

    Route::get('nieuws', [
        'as' => 'news.index',
        'uses' => 'NewsController@getRegionNewsIndex',
    ]);

    Route::get('aanbiedingen', [
        'as' => 'offer.index',
        'uses' => 'OfferController@getRegionOfferIndex',
    ]);

    Route::get('zoeken', [
        'as' => 'search',
        'uses' => 'SearchController@getBasicSearch',
    ]);

    Route::post('zoeken', [
        'as' => 'ajaxsearch',
        'uses' => 'SearchController@postAjaxSearch',
    ]);

    Route::group([
        'prefix' => '{company}',
        'as' => 'company.'
    ], function () {
        Route::get('/', [
            'as' => 'detail',
            'uses' => 'CompanyController@getCompanyDetail',
        ]);        
        Route::get('nieuws', [
            'as' => 'news.index',
            'uses' => 'NewsController@getCompanyNewsIndex',
        ]);
        Route::get('nieuws/{news}', [
            'as' => 'news.detail',
            'uses' => 'NewsController@getNewsDetail',
        ]);
        
        Route::get('advertisement', [
            'as' => 'advt.index',
            'uses' => 'AdvertisementController@getCompanyAdvtIndex',
        ]);

        Route::get('advertisement/{advt}', [
            'as' => 'advt.detail',
            'uses' => 'AdvertisementController@getAdvtDetail',
        ]);

        Route::get('vacatures', [
            'as' => 'vacancy.index',
            'uses' => 'VacancyController@getCompanyVacancyIndex',
        ]);

        Route::get('vacature/{vacancy}', [
            'as' => 'vacancy.detail',
            'uses' => 'VacancyController@getVacancyDetail',
        ]);

        Route::get('aanbiedingen', [
            'as' => 'offer.index',
            'uses' => 'OfferController@getCompanyOfferIndex',
        ]);

        Route::get('aanbieding/{offer}', [
            'as' => 'offer.detail',
            'uses' => 'OfferController@getOfferDetail',
        ]);
    });
});