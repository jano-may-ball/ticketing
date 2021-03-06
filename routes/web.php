<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2019 Andrew Ying and other contributors.
 *
 * This file is part of Jano Ticketing System.
 *
 * Jano Ticketing System is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License
 * v3.0 supplemented by additional permissions and terms as published at
 * COPYING.md.
 *
 * Jano Ticketing System is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

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

Route::get('/', 'HomeController@index');
Route::get('event', 'EventController@show');
Route::get('account', 'AccountController@view')->name('accounts.view');
Route::resource('attendees', 'AttendeeController', ['except' => ['list', 'view']]);

Route::group([
    'namespace' => 'Backend',
    'prefix' => 'admin',
    'as' => 'backend.'
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('about', 'HomeController@about')->name('about');

    Route::get('clients', '\Laravel\Passport\Http\Controllers\ClientController@forUser');
    Route::post('clients', '\Laravel\Passport\Http\Controllers\ClientController@store');
    Route::put('clients/{client_id}', '\Laravel\Passport\Http\Controllers\ClientController@update');
    Route::delete('clients/{client_id}', '\Laravel\Passport\Http\Controllers\ClientController@destroy');

    Route::resource('users', 'UserController');
    Route::resource('groups', 'GroupController');

    Route::resource('attendees', 'AttendeeController');
    Route::resource('tickets', 'TicketController');

    Route::get('payments/import', 'PaymentImportController@create')->name('paymentimports.create');
    Route::post('payments/import', 'PaymentImportController@store')->name('paymentimports.store');
    Route::put('payments/import', 'PaymentImportController@update')->name('paymentimports.update');
    Route::resource('payments', 'PaymentController');

    Route::resource('jobs', 'JobController')->only(['store']);

    Route::resource('staffs', 'StaffController');
    Route::get('settings', 'SettingController@index')->name('settings.index');
    Route::put('settings', 'SettingController@update')->name('settings.update');
});

Route::auth(['verify' => true]);
