<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// ==================== MAIN ROUTE ==================== \\
Route::get('/', 'HomeController@index');

Route::get('js/{file?}', function ($file = '') {
    $path = '/js/';

    if (EMPTY($file)) return redirect()->back();
    if ($file) $path = '/js/' . $file . '.js';

});
// ==================== BASIC ROUTE ==================== \\
Route::get('organizations', 'HomeController@organization');
Route::get('grade', 'HomeController@grade');
Route::get('position', 'HomeController@position');
Route::get('organization-level', 'HomeController@organization_level');

Route::group(['prefix' => 'organizations'], function () {
    Route::get('add', 'HomeController@form_add_organization');
    Route::get('edit/{id?}', 'HomeController@form_edit_organization');
    Route::get('detail/{id?}', 'HomeController@form_detail_organization');
    Route::get('get_sub_group_id/{id?}', 'OrganizationController@get_sub_group_id');
    Route::get('datatable/{id?}', 'OrganizationController@form_datatable_organization');

    Route::post('save', 'OrganizationController@saveOrganization');
    Route::post('upload/{id?}', 'OrganizationController@uploadOrganization');
    Route::post('delete-organization', 'OrganizationController@deleteOrganization');
    Route::post('delete', 'OrganizationController@delete');  # set disable
    Route::post('deletes', 'OrganizationController@deletes'); # set enable
});

Route::group(['prefix' => 'employee'], function () {
    Route::get('add/{id?}', 'VoucherController@form_add_organizationa');
    Route::get('edit/{id?}', 'VoucherController@form_edit_organization');
    Route::get('detail/{id?}', 'VoucherController@form_edit_organization');
    Route::get('datatable/{id?}', 'VoucherController@form_datatable_organization');

    Route::post('save', 'VoucherController@saveEmployee');
    Route::post('upload', 'VoucherController@uploadOrganization');
    Route::post('delete-employee', 'VoucherController@deleteOrganization');
    Route::post('delete', 'VoucherController@delete');  # set disable
    Route::post('deletes', 'VoucherController@deletes'); # set enable
});

Route::group(['prefix' => 'grade'], function () {
    Route::post('save', 'GradeController@saveData');
    Route::post('delete', 'GradeController@deleteData');
});
Route::group(['prefix' => 'position'], function () {
    Route::post('save', 'PositionController@saveData');
    Route::post('delete', 'PositionController@deleteData');
});
Route::group(['prefix' => 'orlevel'], function () {
    Route::post('save', 'OrganizationController@saveData');
    Route::post('delete', 'OrganizationController@deleteData');
});

Route::group(['prefix' => 'user-manager'], function () {
    Route::get('/', 'HomeController@userManager');
    Route::get('create', 'HomeController@createUser');
    Route::post('create', 'Auth\CustomAuthController@create');
    Route::get('profile/{id?}', 'HomeController@profile');
    Route::post('profile/{id?}', ['middleware' => 'auth', 'uses' => 'Auth\CustomAuthController@update']);
    Route::post('delete', ['middleware' => 'auth', 'uses' => 'Auth\CustomAuthController@remove']);
});


# ==================== AUTHENTICATE ROUTE ==================== #
#
# Login Page
Route::get('login', ['middleware' => 'guest', 'uses' => 'Auth\CustomAuthController@login']);
#
# Login Authenticate
Route::post('login', ['middleware' => 'guest', 'uses' => 'Auth\CustomAuthController@authenticate']);
#
# Logout
Route::get('logout', ['middleware' => 'auth', 'uses' => 'Auth\CustomAuthController@logout']);

Route::get('/trtempl/assets/', [
    'as' => 'trtempl.assets',
    'uses' => function () {
        return Datatables::eloquent(\App\Http\Models\Organization::select('*')
            ->orderBy('organization_name', 'asc'))
            ->make(true);
    }
]);
Route::get('/trtempl/employee/{id}', [
    'as' => 'trtempl.assets.id',
    'uses' => function ($id) {
        return Datatables::eloquent(\App\Http\Models\Voucher::select('*')
            ->where('organization_id', '=', $id))
            ->make(true);
    }
]);