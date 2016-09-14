<?php

Route::group(['as' => 'global.'], function() {
    Route::get('over-villato', [
        'as' => 'about',
        'uses' => 'IndexController@getAbout'
    ]);
    Route::post('feedback', [
        'as' => 'feedback',
        'uses' => 'FeedbackController@postFeedback'
    ]);

    Route::get('registreren', [
        'as' => 'register',
        'uses' => 'Auth\AuthController@getRegister'
    ]);

    Route::post('registreren', [
        'as' => 'register',
        'uses' => 'Auth\AuthController@postRegister',
    ]);
    Route::get('getdone', [
        'as' => 'getdone',
        'uses' => 'Auth\AuthController@getDone',
    ]);

    Route::get('inloggen', [
        'as' => 'login',
        'uses' => 'Auth\AuthController@getLogin',
    ]);

    Route::post('inloggen', [
        'as' => 'login',
        'uses' => 'Auth\AuthController@postLogin',
    ]);

    Route::get('uitloggen', [
        'as' => 'logout',
        'uses' => 'Auth\AuthController@getLogout',
    ]);

    Route::get('wachtwoord/email', [
        'as' => 'password.email',
        'uses' => 'Auth\PasswordController@getEmail',
    ]);

    Route::post('wachtwoord/email', [
        'as' => 'password.email',
        'uses' => 'Auth\PasswordController@postEmail',
    ]);

    Route::get('wachtwoord/reset', [
        'as' => 'password.reset',
        'uses' => 'Auth\PasswordController@getReset',
    ]);
    Route::post('getproductsbycat', [
        'as' => 'getproductsbycat',
        'uses' => 'Auth\AuthController@getProductsByCat',
    ]);
     Route::post('getcategorybyregion', [
        'as' => 'getcategorybyregion',
        'uses' => 'Auth\AuthController@getCategoryByRegion',
    ]);

    Route::post('wachtwoord/reset', [
        'as' => 'password.reset',
        'uses' => 'Auth\PasswordController@postReset',
    ]);

    Route::group([
        'prefix' => 'mijn-villato',
        'as' => 'account.',
        'middleware' => 'auth'
    ], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'AccountController@getIndex',
        ]);

        Route::get('uitschrijven', [
            'as' => 'newsletter.unsubscribe',
            'uses' => 'AccountController@getNewsletterUnsubscribe',
        ]);

        Route::post('checkideal', [
            'as' => 'checkideal',
            'uses' => 'AccountController@checkiDeal',
        ]);
        Route::get('addtocart', [
            'as' => 'addtocart',
            'uses' => 'AccountController@addToCart',
        ]);
        Route::get('response', [
            'as' => 'response',
            'uses' => 'AccountController@idealreturn',
        ]);
        Route::get('changepassword', [
            'as' => 'changepassword',
            'uses' => 'AccountController@passwordChange',
        ]);
        Route::get('accountadvt', [
            'as' => 'accountadvt',
            'uses' => 'AccountController@accountAdvertisement',
        ]);
        Route::get('productregion', [
            'as' => 'productregion',
            'uses' => 'AccountController@accountProductRegion',
        ]);
        Route::get('balance', [
            'as' => 'balance',
            'uses' => 'AccountController@accountBalance',
        ]);
        Route::group([
            'prefix' => 'create',
            'as' => 'create.',
        ], function () {
            Route::post('offer', [
                'as' => 'offer',
                'uses' => 'AccountController@postCreateOffer',
            ]);

            Route::post('news', [
                'as' => 'news',
                'uses' => 'AccountController@postCreateNews',
            ]);

            Route::post('vacancy', [
                'as' => 'vacancy',
                'uses' => 'AccountController@postCreateVacancy',
            ]);
            Route::post('advertisement', [
                'as' => 'advertisement',
                'uses' => 'AccountController@postCreateAdvt',
            ]);

            
        });

        Route::group([
            'prefix' => 'insert',
            'as' => 'insert.',
        ], function () {            
            Route::post('addregion', [
                'as' => 'addregion',
                'uses' => 'AccountController@addRegion',
            ]);
            Route::post('addcategory', [
                'as' => 'addcategory',
                'uses' => 'AccountController@addCategory',
            ]);   
            Route::post('addproduct', [
                'as' => 'addproduct',
                'uses' => 'AccountController@addProduct',
            ]);          
        });

        Route::group([
            'prefix' => 'update',
            'as' => 'update.',
        ], function () {
            Route::post('advertisement', [
                'as' => 'advertisement',
                'uses' => 'AccountController@postUpdateAdvt',
            ]);
            Route::post('company', [
                'as' => 'company',
                'uses' => 'AccountController@postUpdateCompany',
            ]);

            Route::post('password', [
                'as' => 'password',
                'uses' => 'AccountController@postUpdatePassword',
            ]);

            Route::post('offer', [
                'as' => 'offer',
                'uses' => 'AccountController@postUpdateOffer',
            ]);

            Route::post('news', [
                'as' => 'news',
                'uses' => 'AccountController@postUpdateNews',
            ]);

            Route::post('vacancy', [
                'as' => 'vacancy',
                'uses' => 'AccountController@postUpdateVacancy',
            ]);

            Route::post('products', [
                'as' => 'products',
                'uses' => 'AccountController@postUpdateProducts',
            ]);
            
        });

        Route::group([
            'prefix' => 'get',
            'as' => 'get.',
        ], function () {
            Route::get('offer/{offer}', [
                'as' => 'offer',
                'uses' => 'AccountController@getOffer',
            ]);

            Route::get('news/{news}', [
                'as' => 'news',
                'uses' => 'AccountController@getNews',
            ]);

            Route::get('vacancy/{vacancy}', [
                'as' => 'vacancy',
                'uses' => 'AccountController@getVacancy',
            ]);

            Route::get('products', [
                'as' => 'products',
                'uses' => 'AccountController@getProducts',
            ]);
        });

        Route::group([
            'prefix' => 'delete',
            'as' => 'delete.',
        ], function () {
            Route::post('offer/{offer}', [
                'as' => 'offer',
                'uses' => 'AccountController@postDeleteOffer',
            ]);

            Route::post('news/{news}', [
                'as' => 'news',
                'uses' => 'AccountController@postDeleteNews',
            ]);

            Route::post('vacancy/{vacancy}', [
                'as' => 'vacancy',
                'uses' => 'AccountController@postDeleteVacancy',
            ]);
            Route::get('product/{product}', [
                'as' => 'product',
                'uses' => 'AccountController@postDeleteProduct',
            ]);
            Route::get('category/{category}', [
                'as' => 'category',
                'uses' => 'AccountController@postDeleteCategory',
            ]);
            Route::get('region/{region}', [
                'as' => 'region',
                'uses' => 'AccountController@postDeleteRegion',
            ]);
        });
    });
});









Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/', [
        'as' => 'admin.index',
        'uses' => 'Admin\IndexController@getIndex',
    ]);
    Route::get('resetpassword', [
        'as' => 'admin.index.resetpassword',
        'uses' => 'Admin\IndexController@resetPassword',
    ]);
     Route::get('paymenttransactions', [
        'as' => 'admin.index.transactions',
        'uses' => 'Admin\IndexController@paymentTransactions',
    ]);
     
    Route::get('uitloggen', [
        'as' => 'logout',
        'uses' => 'Auth\AuthController@getLogout',
    ]);
    

    Route::get('region/data', [
        'as' => 'admin.region.data',
        'uses' => 'Admin\RegionController@data',
    ]);

    Route::resource('region', 'Admin\RegionController');

    Route::get('category/data', [
        'as' => 'admin.category.data',
        'uses' => 'Admin\CategoryController@data',
    ]);

    Route::resource('category', 'Admin\CategoryController');

    Route::get('categoryadvt/data', [
        'as' => 'admin.categoryadvt.data',
        'uses' => 'Admin\CategoryadvtController@data',
    ]);

    Route::resource('categoryadvt', 'Admin\CategoryadvtController');

    Route::get('product/data', [
        'as' => 'admin.product.data',
        'uses' => 'Admin\ProductController@data',
    ]);

    Route::resource('product', 'Admin\ProductController');

    Route::get('advertisement/data', [
        'as' => 'admin.advertisement.data',
        'uses' => 'Admin\AdvertisementController@data',
    ]);

    Route::resource('advertisement', 'Admin\AdvertisementController');

    Route::get('company/data', [
        'as' => 'admin.company.data',
        'uses' => 'Admin\CompanyController@data',
    ]);

    Route::resource('company', 'Admin\CompanyController');

    Route::get('vacancy/data', [
        'as' => 'admin.vacancy.data',
        'uses' => 'Admin\VacancyController@data',
    ]);

    Route::resource('vacancy', 'Admin\VacancyController');

    Route::get('offer/data', [
        'as' => 'admin.offer.data',
        'uses' => 'Admin\OfferController@data',
    ]);

    Route::resource('offer', 'Admin\OfferController');

    Route::get('news/data', [
        'as' => 'admin.news.data',
        'uses' => 'Admin\NewsController@data',
    ]);

    Route::resource('news', 'Admin\NewsController');
    Route::get('cms/data', [
        'as' => 'admin.cms.data',
        'uses' => 'Admin\CmsController@data',
    ]);
    Route::resource('cms', 'Admin\CmsController');
    
});

