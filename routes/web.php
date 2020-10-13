<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@getIndex');
// admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login','AdminController@getLogin');
    Route::post('/login','AdminController@postLogin');
    // logout
    Route::get('/logout','AdminController@getLogout');
    Route::get('/dashboard','AdminController@getDashboard')->middleware('checkLoginAdmin');
    Route::group(['prefix' => 'sitters','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@getSitters');
        Route::get('/detail/{id}','AdminController@getDetailSitter');
        Route::get('/detail/delete_feedback/{id}','AdminController@deleteFeedbackSitter'); // delete feedback
        Route::post('/detail/update_status/{id}','AdminController@updateStatusSitter');

        Route::get('/delete/{id}','AdminController@getDeleteSitter'); //delete
        Route::get('/block/{id}','AdminController@getBlockSitter'); //block
    });

    Route::group(['prefix' => 'parents','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@getParents');
        Route::get('/detail/{id}','AdminController@getDetailParent');
        Route::get('/detail/delete_feedback/{id}','AdminController@deleteFeedbackParent'); //delete feedback parent
        Route::get('/delete_parent/{id}','AdminController@getDeleteParent'); //delete parent

        Route::get('/detail/delete_post/{id}','AdminController@deletePostParent'); //delete post Parent
    });
    Route::group(['prefix' => 'posts','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@allPost');
    });
    Route::group(['prefix' => 'contracts','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@getContracts');
        Route::get('/delete_contract/{id}','AdminController@deleteContract');
    });
});
// parent
Route::group(['prefix' => 'parent'], function () {
    Route::get('/','ParentsController@getIndex')->middleware('checkLoginParents');
    // register
    Route::group(['prefix' => 'register'], function () {
        Route::get('/','ParentsController@getRegister');
        Route::post('/','ParentsController@postRegister');
    });
    //
    // login
    Route::group(['prefix' => 'login'], function () {
        Route::get('/','ParentsController@getRegister');
        Route::post('/','ParentsController@postLogin');
    });
    //logout
    Route::get('/logout','ParentsController@logout');

    // profile
    Route::group(['prefix' => 'profile','middleware'=>'checkLoginParents'], function () {
        Route::get('/','ParentsController@getProfile');
        Route::post('/image_update','ParentsController@postImageUpdate');
        Route::post('/location_update','ParentsController@postLocationUpdate');

        // posts manage
        Route::get('/posts','ParentsController@getPostsParent');
    });
    // list_babysitter
    Route::get('/list_sitters','ParentsController@getListSitters')->middleware('checkLoginParents');

    // profile_sitter
    Route::get('sitter_profile/{id}','ParentsController@getSitterProfile')->middleware('checkLoginParents');
    // view profile parent by ID
    Route::get('parent_profile/{id}','ParentsController@getProfileParentId')->middleware('checkLoginParents');

    //save sitter
    Route::get('/save_sitters','ParentsController@getSaveSitters')->middleware('checkLoginParents');
    Route::get('/save_sitters/{id}','ParentsController@getSaveSittersId')->middleware('checkLoginParents');
    Route::get('/save_sitters/delete/{id}','ParentsController@getDeleteSaveSitter')->middleware('checkLoginParents'); //delete save sitter

     // group posts
     Route::group(['prefix' => 'posts','middleware'=>'checkLoginParents'], function () {
        Route::get('/','ParentsController@getPostsList');
        Route::get('/add','ParentsController@getPostAdd');

        Route::post('/add','ParentsController@postAddPost')->name('post.add');

        //delete post
        Route::get('/delete/{id}','ParentsController@getDeletePost');
    });
    // rate sitters
    Route::post('/rate_sitter/{id}','ParentsController@postRateSitter')->middleware('checkLoginParents');
    // contract
    Route::group(['prefix' => 'contract','middleware'=>'checkLoginParents'], function () {
        Route::get('/sendRequest/{id}','ParentsController@sendRequestContractSitter');
    });
    //chat
    Route::group(['prefix' => 'chat','middleware'=>'checkLoginParents'], function () {
        Route::get('/','ParentsController@getChat');
        Route::get('/{id}','ParentsController@showChatSitter');
        Route::post('/{id}','ParentsController@postShowChatSitter');
    });

    // delete account
    Route::get('/delete_account','ParentsController@deleteAccount')->middleware('checkLoginParents');
});

//ajax
Route::post('showDistricts','HomeController@showDistricts');    // show districts
Route::post('showWards','HomeController@showWards');    // show wards
//

//babysitter
Route::group(['prefix' => 'sitter'], function () {
    Route::get('/','SittersController@getIndex')->middleware('checkLoginSitters');
    // login
    Route::group(['prefix' => 'login'], function () {
        Route::get('/','SittersController@getRegister');
        Route::post('/','SittersController@postLogin');
    });
    Route::group(['prefix' => 'register'], function () {
        Route::get('/','SittersController@getRegister');
        Route::post('/','SittersController@postRegister');
    });
    // logout
    Route::get('logout','SittersController@logout');
    // profile
    Route::group(['prefix' => 'profile','middleware'=>'checkLoginSitters'], function () {
        // view profile
        Route::get('/','SittersController@getProfile');
        // update profile
        Route::get('/update_info','SittersController@getUpdateProfile');
        Route::post('/update_info','SittersController@postUpdateProfile');
        // manage images
        Route::post('/images','SittersController@postImagesProfile');
        Route::get('/images_delete/{id}','SittersController@getDeleteImageProfile');
        // update location
        Route::post('/location_update','SittersController@postLocationUpdate');//update location

        // update work time
        Route::post('/update_work','SittersController@updateWorkTime')->name('post.update_work');
    });

    // parents list
    Route::get('/parents_list','SittersController@getParentsList')->middleware('checkLoginSitters');

    // parent profile
    Route::get('/parent_profile/{id}','SittersController@getParentProfile')->middleware('checkLoginSitters');
    // post feedback to parent profile
    Route::post('/feedback_parent/{id_parent}','SittersController@postFeedbackParent')->middleware('checkLoginSitters');

    // group post
    Route::group(['prefix' => 'posts','middleware'=>'checkLoginSitters'], function () {
        Route::get('/','SittersController@getPostsList');
        Route::get('/save/{id}','SittersController@getSavePostId');
        Route::get('/save','SittersController@getSaveList');

        Route::get('/save_delete/{id}','SittersController@getSaveDelete');
    });
    // contract
    Route::group(['prefix' => 'contract','middleware'=>'checkLoginSitters'], function () {
        Route::get('/sendRequest/{id}','SittersController@sendRequestContractParent');
        Route::get('/accept/{id}','SittersController@AcceptContract');
    });
    // chat
    Route::group(['prefix' => 'chat','middleware'=>'checkLoginSitters'], function () {
        Route::get('/','SittersController@getChat');
        Route::get('/{id}','SittersController@showChatParent');
        Route::post('/{id}','SittersController@postShowChatParent');
    });

    //delete acc
    Route::get('/delete_account','SittersController@deleteAccount')->middleware('checkLoginSitters');
});
