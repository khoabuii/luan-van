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
        Route::get('/pdf','AdminController@createPDFListSitter')->name('exportListSitter');
        Route::get('/detail/{id}','AdminController@getDetailSitter');
        Route::get('/detail/delete_feedback/{id}','AdminController@deleteFeedbackSitter'); // delete feedback
        Route::post('/detail/update_status/{id}','AdminController@updateStatusSitter');

        Route::get('/active/{id}','AdminController@activeSitter'); // active
        Route::get('/cancel_active/{id}','AdminController@cancelActiveSitter'); // cancel active
        Route::get('/block/{id}','AdminController@getBlockSitter'); //block
        //skill
        Route::get('/skill','AdminController@showSkill');
        Route::post('/skill/add','AdminController@addSkill');
        Route::get('/skill/delete/{id}','AdminController@deleteSkill');
    });

    Route::group(['prefix' => 'parents','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@getParents');
        Route::get('/pdf','AdminController@createPDFParent');

        Route::get('/detail/{id}','AdminController@getDetailParent');
        Route::get('/detail/delete_feedback/{id}','AdminController@deleteFeedbackParent'); //delete feedback parent
        Route::get('/delete_parent/{id}','AdminController@getDeleteParent'); //delete parent

        Route::get('/detail/delete_post/{id}','AdminController@deletePostParent'); //delete post Parent
    });
    Route::group(['prefix' => 'posts','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@allPost');
        Route::get('/pdf','AdminController@createPDFPosts');
        Route::get('/delete/{id}','AdminController@deletePost');
    });
    Route::group(['prefix' => 'contracts','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@getContracts');
        Route::get('/pdf','AdminController@createPDFContracts');

        Route::get('/delete_contract/{id}','AdminController@deleteContract');
    });
    Route::group(['prefix' => 'message','middleware'=>'checkLoginAdmin'], function () {
        Route::get('/','AdminController@getMessage');
        Route::post('/','AdminController@postMessage');

        Route::get('/sitters','AdminController@getMessage');
        Route::post('/sitters','AdminController@postMessage');

        Route::get('/parents','AdminController@getMessage');
        Route::post('/parents','AdminController@postMessage');
    });
    Route::get('test_noti','AdminController@notiToAll');
});

// parent
Route::group(['prefix' => 'parent'], function () {
    Route::get('/','ParentsController@getIndex')->name('parent.index');
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

        Route::post('reset_password','ParentsController@sendMailToReset');
        Route::get('reset_password/{token}','ParentsController@resetPassword');
    });
    //logout
    Route::get('/logout','ParentsController@logout');

    // profile
    Route::group(['prefix' => 'profile','middleware'=>'checkLoginParents'], function () {
        Route::get('/','ParentsController@getProfile');
        Route::post('/image_update','ParentsController@postImageUpdate');
        Route::post('/location_update','ParentsController@postLocationUpdate');

        Route::post('/update-activity','ParentsController@updateWorkTime')->name('post.update_activity.parent');
        // posts manage
        Route::get('/posts','ParentsController@getPostsParent');

        //update info
        Route::get('/update_info','ParentsController@getUpdateInfo');
        Route::post('/update_info','ParentsController@postUpdateInfo');
    });
    // list_babysitter
    Route::get('/list_sitters','ParentsController@getListSitters')->middleware('checkLoginParents');
    // search sitter
    Route::get('/search_sitter','ParentsController@searchSitter')->name('search.sitters');

    // profile_sitter
    Route::get('sitter_profile/{id}','ParentsController@getSitterProfile');
    // view profile parent by ID
    Route::get('parent_profile/{id}','ParentsController@getProfileParentId')->middleware('checkLoginParents');

    //save sitter
    Route::get('/save_sitters','ParentsController@getSaveSitters')->middleware('checkLoginParents')->name('parent.save_sitters');
    Route::get('/save_sitters/{id}','ParentsController@getSaveSittersId')->middleware('checkLoginParents');
    Route::get('/save_sitters/delete/{id}','ParentsController@getDeleteSaveSitter')->middleware('checkLoginParents'); //delete save sitter

     // group posts
     Route::group(['prefix' => 'posts','middleware'=>'checkLoginParents'], function () {
        Route::get('/','ParentsController@getPostsList');
        Route::get('/add','ParentsController@getPostAdd');

        Route::post('/add','ParentsController@postAddPost')->name('post.add');

        // sitter post
        Route::get('/sitter/{id}','ParentsController@sitterPost');

        //delete post
        Route::get('/delete/{id}','ParentsController@getDeletePost');

        Route::get('/comment/{id}','ParentsController@postComment');

        Route::get('/delete_comment/{id}','ParentsController@deleteComment');
    });
    // rate sitters
    Route::post('/rate_sitter/{id}','ParentsController@postRateSitter')->middleware('checkLoginParents');
    // delete feedback
    Route::get('/delete_feedback/{id}','ParentsController@deleteFeedback')->middleware('checkLoginParents');

    // contract
    Route::group(['prefix' => 'contract','middleware'=>'checkLoginParents'], function () {
        Route::get('/','ParentsController@getContract');
        Route::get('/{id}','ParentsController@detailContract');
        Route::get('/pdf/{id}','ParentsController@exportContract');

        Route::get('/sendRequest/{id}','ParentsController@sendRequestContractSitter');

        Route::get('/accept/{id}','ParentsController@acceptContract');
        Route::get('/cancel/{id}','ParentsController@cancelContract');
    });
    //chat
    Route::group(['prefix' => 'chat','middleware'=>'checkLoginParents'], function () {
        Route::get('/','ParentsController@getChat');
        Route::get('/{id}','ParentsController@showChatSitter');
        Route::get('/sentNoti/{id}','ParentsController@sentNoti');
    });
    // delete account
    Route::get('/delete_account','ParentsController@deleteAccount')->middleware('checkLoginParents');
});

//ajax
Route::post('showDistricts','HomeController@showDistricts');    // show districts
Route::post('showWards','HomeController@showWards');    // show wards

Route::get('/posts/what_is_babysitter','HomeController@postsTest');
//


// babysitter
Route::group(['prefix' => 'sitter'], function () {
    Route::get('/','SittersController@getIndex');
    // login
    Route::group(['prefix' => 'login'], function () {
        Route::get('/','SittersController@getRegister');
        Route::post('/','SittersController@postLogin');

        Route::post('reset_password','SittersController@sendMailToReset');
        Route::get('reset_password/{token}','SittersController@resetPassword');
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
        // add skill
        Route::get('/add_skill','SittersController@addSkill')->name('addSkill');
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
    // search parent
    Route::get('/search_parent','SittersController@searchParent');

    // parent profile
    Route::get('/parent_profile/{id}','SittersController@getParentProfile');

    // post feedback to parent profile
    Route::post('/feedback_parent/{id_parent}','SittersController@postFeedbackParent')->middleware('checkLoginSitters');

    // delete feedback
    Route::get('/delete_feedback/{id}','SittersController@deleteFeedback')->middleware('checkLoginSitters');

    // group post
    Route::group(['prefix' => 'posts','middleware'=>'checkLoginSitters'], function () {
        Route::get('/','SittersController@getPostsList');
        Route::post('/add','SittersController@addPost');

        Route::get('/save/{id}','SittersController@getSavePostId');
        Route::get('/save','SittersController@getSaveList');

        Route::get('/save_delete/{id}','SittersController@getSaveDelete');

        Route::get('/parent/{id}','SittersController@parentPosts');

        Route::get('/me','SittersController@myPosts');

        Route::get('/comment/{id}','SittersController@postComment');
        Route::get('/delete_comment/{id}','ParentsController@deleteComment');
    });
    // contract
    Route::group(['prefix' => 'contract','middleware'=>'checkLoginSitters'], function () {
        Route::get('/','SittersController@getContracts');
        Route::get('/sendRequest/{id}','SittersController@sendRequestContractParent');
        Route::get('/pdf/{id}','SittersController@exportContract');

        Route::get('/accept/{id}','SittersController@acceptContract');
        Route::get('/cancel/{id}','SittersController@cancelContract');
    });
    // chat
    Route::group(['prefix' => 'chat','middleware'=>'checkLoginSitters'], function () {
        Route::get('/','SittersController@getChat');
        Route::get('/{id}','SittersController@showChatParent');
        Route::get('/sentNoti/{id}','SittersController@sentNoti');
    });

    //delete acc
    Route::get('/delete_account','SittersController@deleteAccount')->middleware('checkLoginSitters');
});
