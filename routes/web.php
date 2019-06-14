<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    /**
     * Authentication routes
     */
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/', 'AuthController@getIndex');
        Route::get('/login', 'AuthController@getIndex');
        Route::post('/login', 'AuthController@postLogin')->name('admin.login');
        Route::get('/logout', 'AuthController@getLogout')->name('admin.logout');
        Route::get('/recover-password', 'AuthController@getRecoverPassword');
        Route::post('/recover-password', 'AuthController@postRecoverPassword');
        Route::get('/change-password/{hash}', 'AuthController@getChangePassword');
        Route::post('/change-password', 'AuthController@postChangePassword');
    });

    Route::group(['middleware' => 'auth.admin'], function () {

        /*
         * home route
         */

        Route::get('/', ['as' => 'admin.home', 'uses' => 'HomeController@getIndex']);

        /*
         * Settings routes
         */
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', ['as' => 'admin.settings', 'uses' => 'SettingsController@getIndex']);
            Route::post('/', ['as' => 'admin.settings', 'uses' => 'SettingsController@postIndex']);
        });

        /*
         * admin routes
         */
        Route::group(['prefix' => 'admins'], function () {
            Route::get('/', ['as' => 'admin.admins', 'uses' => 'AdminController@getIndex']);
            Route::post('/', ['as' => 'admin.admins', 'uses' => 'AdminController@postIndex']);
            Route::get('/edit/{id}', ['as' => 'admin.admins.edit', 'uses' => 'AdminController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.admins.edit', 'uses' => 'AdminController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.admins.delete', 'uses' => 'AdminController@getDelete']);
        });

        /*
         * Site Routes
         */
        Route::group(['prefix' => 'site-users'] ,function (){
            Route::get('/' ,['as' => 'admin.site.users' ,'uses' => 'SiteMembersController@getIndex']);
            Route::get('/delete/{id}' ,['as' => 'admin.users.delete' ,'uses' => 'SiteMembersController@getDelete']);
            Route::post('/active' ,['as' => 'admin.users.active' ,'uses' => 'SiteMembersController@postActive']);
            Route::post('/package' ,['as' => 'admin.users.choose-package' ,'uses' => 'SiteMembersController@postPackage']);
            // Send Messages
            Route::get('/send-message/{id}' ,['as' => 'admin.users.send-message' ,'uses' => 'SiteMembersController@sendMessages']);
        });

        /*
         * About routes
         */
        Route::group(['prefix' => 'about'], function () {
            Route::get('/', ['as' => 'admin.about', 'uses' => 'AboutController@getIndex']);
            Route::get('/section/{flug}', ['as' => 'admin.about.sec', 'uses' => 'AboutController@getSection']);
            Route::post('/update', ['as' => 'admin.about.update', 'uses' => 'AboutController@postUpdate']);
        });

        /*
         * Contact us routes
         */
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', ['as' => 'admin.contact', 'uses' => 'ContactUsController@getIndex']);
            Route::post('/', ['as' => 'admin.contact', 'uses' => 'ContactUsController@postIndex']);
            Route::get('/edit/{id}', ['as' => 'admin.contact.edit', 'uses' => 'ContactUsController@getEdit']);
            Route::post('/update', ['as' => 'admin.contact.update', 'uses' => 'ContactUsController@postUpdate']);
            Route::get('/delete/{id}', ['as' => 'admin.contact.delete', 'uses' => 'ContactUsController@getDelete']);
        });

        /*
         * Meta tags routes
         */
        Route::group(['prefix' => 'meta'], function () {
            Route::get('/', ['as' => 'admin.meta', 'uses' => 'MetaController@getIndex']);
            Route::post('/', ['as' => 'admin.meta', 'uses' => 'MetaController@postIndex']);
            Route::get('/edit/{id}', ['as' => 'admin.meta.edit', 'uses' => 'MetaController@getEdit']);
            Route::post('/update', ['as' => 'admin.meta.update', 'uses' => 'MetaController@postUpdate']);
            Route::get('/delete/{id}', ['as' => 'admin.meta.delete', 'uses' => 'MetaController@getDelete']);
        });

        /**
         * Notifications Route
         */
        Route::group(['prefix'=>'notifications'],function (){
            Route::get('/', ['as' => 'admin.notifications', 'uses' => 'NotificationController@getIndex']);
            Route::get('/{id}', ['as' => 'admin.notifications.only', 'uses' => 'NotificationController@getOne']);
            Route::post('/send/massage', ['as' => 'admin.notifications.send', 'uses' => 'NotificationController@postMessage']);
            Route::get('/show/header', ['as' => 'admin.notifications.header', 'uses' => 'NotificationController@showNotification']);
        });

        /*
         * Subscriber routes
         */
        Route::group(['prefix' => 'subscriber'], function () {
            Route::get('/', ['as' => 'admin.subscriber', 'uses' => 'SubscriberController@getIndex']);
            Route::post('/', ['as' => 'admin.subscriber', 'uses' => 'SubscriberController@postIndex']);
        });

        /*
         * country routes
         */
        Route::group(['prefix' => 'countries'], function () {
            Route::get('/', ['as' => 'admin.countries', 'uses' => 'CountryController@getCountry']);
            Route::post('/', ['as' => 'admin.countries', 'uses' => 'CountryController@postIndex']);
            Route::post('/edit/{id}', ['as' => 'admin.countries.edit', 'uses' => 'CountryController@postEditCountry']);
            Route::get('/delete/{id}', ['as' => 'admin.countries.delete', 'uses' => 'CountryController@getDeleteCountry']);
        });
        /*
         * cities routes
         */
        Route::group(['prefix' => 'cities'], function () {
            Route::get('/{id}', ['as' => 'admin.cities', 'uses' => 'CountryController@getCity']);
            Route::post('/edit/{id}', ['as' => 'admin.cities.edit', 'uses' => 'CountryController@postEditCity']);
            Route::get('/delete/{id}', ['as' => 'admin.cities.delete', 'uses' => 'CountryController@getDeleteCity']);
            Route::post('/' ,['as' => 'admin.cities.add' ,'uses' => 'CountryController@postAddCity']);
        });

        /**
         * Category route
         */
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@getIndex')->name('admin.categories.index');
            Route::post('info/{id}', 'CategoryController@postInfo')->name('admin.categories.info');
            Route::post('/edit/{id}', 'CategoryController@postEdit')->name('admin.categories.edit');
            Route::post('/add/main', 'CategoryController@postAddMain')->name('admin.categories.add-main');
            Route::post('/add/sub', 'CategoryController@postAddSub')->name('admin.categories.add-sub');
            Route::get('/delete/{id}', 'CategoryController@getDelete')->name('admin.categories.delete');
        });


        /**
         * Types route
         */
        Route::group(['prefix' => 'types'], function () {
            Route::get('/{id}' ,['as' => 'admin.types' ,'uses' => 'TypeController@getIndex']);
            Route::post('type' ,['as' => 'admin.types.add' ,'uses' => 'TypeController@postIndex']);
            Route::post('/edit/{id}' ,['as' => 'admin.types.edit' ,'uses' => 'TypeController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.types.delete' ,'uses' => 'TypeController@getDelete']);
        });
        /**
         * Reports routes
         */
        Route::group(['prefix' => 'reports'] ,function (){
            Route::get('/{id}' ,['uses' => 'admin.reports' ,'uses' => 'AdsController@getReports']);
            Route::get('/delete/{id}' ,['uses' => 'admin.report.delete' ,'uses' => 'AdsController@getDeleteReport']);
        });

        /**
         * Ads route
         */
        Route::group(['prefix' => 'ads'], function () {
            Route::get('/' ,['as' => 'admin.ads' ,'uses' => 'AdsController@getIndex']);
            Route::post('/active' ,['as' => 'admin.ad.active' ,'uses' => 'AdsController@postActive']);
            Route::get('/delete/{id}' ,['as' => 'admin.ad.delete' ,'uses' => 'AdsController@getDelete']);
        });


    });
});
///////////////////////////// SITE ROUTES ///////////////////////////////
Route::group(['namespace' => 'Site'] ,function (){

    /**
     * Auth Route
     */
    Route::group(['prefix'=>'auth' ,'namespace' => 'Auth'],function (){
        Route::get('/','AuthController@getLogin')->name('site.login');
        Route::get('/login','AuthController@getLogin')->name('site.login');
        Route::post('/login','AuthController@postLogin')->name('site.login');
        Route::get('/register','AuthController@getRegister')->name('site.register');
        Route::post('/register','AuthController@postRegister')->name('site.register');
        Route::get('/logout','AuthController@logout')->name('site.logout');
        Route::get('/reset-password','AuthController@getResetPassword')->name('site.reset');
        Route::post('/reset-password','AuthController@postResetPassword')->name('site.reset');
        Route::get('/change-password/user/{id}/hash/{hash}','AuthController@getChangePassword')->name('site.change-password');
        Route::post('/change-password/user/{id}/hash/{hash}','AuthController@postChangePassword')->name('site.change-password');

        Route::get('/confirm/{username}','AuthController@getConfirm')->name('site.confirm');
        Route::post('/confirm/{username}','AuthController@postConfirm');

    });

    // Home Route
    Route::get('/' ,['as' => 'site.home' ,'uses' => 'HomeController@getIndex']);
    Route::post('subscriber' ,['as' => 'site.subscribe' ,'uses' => 'HomeController@postSubscribe']);
    Route::get('/search','HomeController@getSearch')->name('site.search');

    //Category routes
    Route::get('/category/{slug}' ,['as' => 'site.category' ,'uses' => 'CategoryController@getIndex']);

    //only-ad route
    Route::get('ads/{slug}' ,['as' => 'site.ad.only' ,'uses' => 'AdController@getIndex']);
    Route::post('wishlist' ,['as' => 'site.wishlist' ,'uses' => 'AdController@postWishlist']);
    Route::post('message/{slug}' ,['as' => 'site.message' ,'uses' => 'AdController@postContactFounder']);
    Route::post('conversation/{slug}' ,['as' => 'site.conversation' ,'uses' => 'AdController@postConversation']);
    Route::post('review/{slug}' ,['as' => 'site.review' ,'uses' => 'AdController@postReview']);
    Route::post('report/{slug}' ,['as' => 'site.report' ,'uses' => 'AdController@postReportAd' ]);
    Route::get('tag/{tag}' ,['as' => 'site.ad.tag' ,'uses' => 'AdTagController@getIndex']);


    //public profile routes
    Route::get('public-profile/{username}' ,['as' => 'site.profile.public' ,'uses' => 'PublicProfileController@getIndex']);
    Route::post('public-profile/{username}' ,['as' => 'site.profile.public' ,'uses' => 'PublicProfileController@postIndex']);
    Route::post('follow/{id}' ,['as' => 'site.profile.follow' ,'uses' => 'PublicProfileController@postFollow']);

    /**
     * Middleware Route
     * Private
     */
    Route::group(['middleware'=>'auth.site'],function (){

        /**
         * Profile Routes
         */

        Route::get('/profile','ProfileController@getIndex')->name('site.profile');
        Route::get('/profile/my-ads','ProfileController@getAds')->name('site.profile.ads');
        Route::get('/profile/my-favorite','ProfileController@getFavorites')->name('site.profile.favorite');
        Route::get('/profile/settings','ProfileController@getSettings')->name('site.profile.settings');
        Route::post('/profile/settings','ProfileController@postSettings')->name('site.profile.settings');
        Route::get('/profile/closeAccount','ProfileController@closeAccount')->name('site.profile.closeAccount');
        Route::get('/profile/packages','ProfileController@getPackages')->name('site.profile.package');
        Route::get('/profile/packages/order/{id}','ProfileController@postPackages')->name('site.profile.order-package');
        Route::post('wishlistDelete/{id}' ,['as' => 'site.wishlist.delete' ,'uses' => 'ProfileController@postDeleteWishlist']);

        //Header notification
        Route::get('/profile/header-notification','ProfileController@showNotification')->name('site.profile.notification');
        Route::get('/profile/notification','ProfileController@getAllNotification')->name('site.profile.get-notification');
        Route::get('/profile/notification/{id}','ProfileController@getSingleNotification')->name('site.profile.get-notification-one');
        Route::post('/profile/notification/send-notification','ProfileController@postSendNotification')->name('site.profile.send-notification');

        Route::post('/delete-image/{ad_id}/{image_id}', 'ProfileController@postDeleteImage')->name('site.ad.images.delete');
        Route::get('ad/edit/{slug}','ProfileController@getEdit')->name('site.ad.edit');
        Route::post('ad/update','ProfileController@postUpdate')->name('site.ad.update');
        Route::get('ad/delete/{slug}','ProfileController@getDelete')->name('site.ad.delete');

        //messages controller
        Route::get('/profile/messages' ,['as' => 'site.profile.messages' ,'uses' => 'MessageController@getIndex']);
        Route::get('/profile/received' ,['as' => 'site.profile.received' ,'uses' => 'MessageController@getReceivedMessages']);
        Route::get('/profile/sent' ,['as' => 'site.profile.sent' ,'uses' => 'MessageController@getSentMessages']);
        Route::get('/profile/message/{id}' ,['as' => 'site.message.only' ,'uses' => 'MessageController@getSingleMessage']);
        Route::post('/profile/message/send-messages' ,['as' => 'site.send-messages' ,'uses' => 'MessageController@postSendMessage']);

        //followers route
        Route::get('/profile/followers' ,['as' => 'site.profile.followers' ,'uses' => 'FollowerController@getIndex']);
        Route::post('/profile/followers/{id}' ,['as' => 'site.followers.delete' ,'uses' => 'FollowerController@postDelete']);
        Route::post('/profile/contact/{id}' ,['as' => 'site.followers.contact' ,'uses' => 'FollowerController@postContact']);

        // save Search Result
        Route::get('/save-search' ,['as' => 'save-search' ,'uses' => 'HomeController@saveSearch']);
        //search  result
        Route::get('/result-search' ,['as' => 'result-search' ,'uses' => 'ProfileController@SearchResult']);
        Route::get('/result-search/delete/{id}' ,['as' => 'result-search-delete' ,'uses' => 'ProfileController@SearchResultDelete']);
    });
    /**
     * Dropzone Route
     */
    Route::post('/upload', 'AdController@dropzoneStore')->name('admin.dropzoneStore');
    Route::post('/deleteDropzoneImage', 'AdController@dropzoneDelete')->name('admin.dropzoneDelete');
    /**
     * Add Ad Route
     */
    Route::get('ad/add','AdController@getAdd')->name('site.add.add');
    Route::get('ad/add/choose','AdController@chooseCat');
    Route::post('ad/add','AdController@postAdd')->name('site.add.add');
});