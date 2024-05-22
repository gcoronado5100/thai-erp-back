<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas para la gestion de Usuarios de la app
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'auth'
], function () {
    /** USERS ROUTES */
    // Session management
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    // CRUD for Users
    Route::post('users/register', [AuthController::class, 'createUser']);
    Route::put('user/{id}', [AuthController::class, 'updateUser']);
    Route::post('user/permissions', [AuthController::class, 'grantPermissions']);
    Route::put('user/permissions', [AuthController::class, 'updatePermissions']);
    Route::delete('user/{id}/permissions', [AuthController::class, 'revoquePermissions']);

    // User Status Update
    Route::put('user/{id}/up', [AuthController::class, 'activateUser']);
    Route::put('user/{id}/down', [AuthController::class, 'deactivateUser']);
    Route::put('user/{id}/password', [AuthController::class, 'changePassword']); // Used for Password Recovery too.

    // CRUD User Settings and Capabilities
    Route::get('userpdvs/{id}', [SettingsController::class, 'getPdvsAvailable']);
    Route::get('usersettings/{id}', [SettingsController::class, 'getSettings']);
    Route::put('usersettings/{id}', [SettingsController::class, 'updateSettings']);

    /** CLIENTS ROUTES */
    Route::post('clients/register', [ClientsController::class, 'createClient']);
    Route::get('clients', [ClientsController::class, 'getClients']);
    Route::get('clients/search={search}', [ClientsController::class, 'searchClients']);
    Route::get('clients/profile/{id}', [ClientsController::class, 'getSingleClient']);
    Route::put('clients/update/{id}', [ClientsController::class, 'updateClient']);

    // Orders
    Route::post('orders/quotes/new', [OrdersController::class, 'createNewQuote']);
    Route::get('orders/quotes/all', [OrdersController::class, 'getAllQuotes']);
    Route::get('orders/sales/all', [OrdersController::class, 'getAllSales']);
    Route::get('orders/cancelled/all', [OrdersController::class, 'getAllCancelled']);
    Route::get('orders/single/{id}', [OrdersController::class, 'getSingleOrder']);
    Route::get('orders/search={search}', [OrdersController::class, 'searchOrders']);
    Route::put('orders/edit/{id}', [OrdersController::class, 'editOrder']);
    Route::put('orders/new-sale/{id}', [OrdersController::class, 'turnToSale']);
    Route::put('orders/approve/{id}', [OrdersController::class, 'approveOrder']);
    Route::put('orders/sale/{id}', [OrdersController::class, 'turnToSale']);
    Route::put('orders/cancel/{id}', [OrdersController::class, 'cancelOrder']);

    // Support

    // Services

    // Inventory

    // Reports

    // Settings

    // Managements
});
