<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the UsersServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| All Routes under "api/users" prefix
*/

Route::get('/', function (Request $request) {
    return 'Users';
});
