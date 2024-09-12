<?php

use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;
use App\Http\Controllers\Api\ChannelController;
use App\Http\Controllers\Api\ContractorController;
use App\Http\Controllers\Api\ContractorSignoffController;
use App\Http\Controllers\Api\GtinNumberController;
use App\Http\Controllers\Api\PartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkOrderController;
use App\Http\Controllers\Api\WorkOrderLineItemController;

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
    // Registering Orion resources using class references
    Orion::resource('channels', ChannelController::class);
    Orion::resource('contractors', ContractorController::class);
    Orion::resource('contractor-signoffs', ContractorSignoffController::class);
    Orion::resource('gtin-numbers', GtinNumberController::class);
    Orion::resource('parts', PartController::class);
    Orion::resource('products', ProductController::class);
    Orion::resource('purchase-orders', PurchaseOrderController::class);
    Orion::resource('sellers', SellerController::class);
    Orion::resource('suppliers', SupplierController::class);
    Orion::resource('users', UserController::class);
    Orion::resource('work-orders', WorkOrderController::class);
    Orion::resource('work-order-line-items', WorkOrderLineItemController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
