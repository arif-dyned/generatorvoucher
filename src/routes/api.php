<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1'], function () {
    Route::get('dsa_rule', 'v1\ApiController@get_dsa_rule');

    Route::get('dsa_flow', 'v1\ApiController@get_dsa_flow');

    Route::get('mt_info', 'v1\ApiController@get_mt_info');

    Route::get('study_path/{name?}', 'v1\ApiController@get_study_path');

    Route::get('lesson/{name?}', 'v1\ApiController@get_lesson');

    Route::get('dsa_flow_list', 'v1\ApiController@get_list_dsa_flow');

    Route::get('mt_info_list', 'v1\ApiController@get_list_mt_info');
});
