<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LockupController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\LockupTypeController;
use App\Http\Controllers\ManageRoleController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ParentPackageController;
use App\Http\Controllers\VariationTypeController;
use App\Http\Controllers\SpecialOccasionController;

Route::group(
    [
        'middleware' => ['auth'],

    ],
    function () {
        #admin profile route
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        // Route::get('/profile', [HomeController::class, 'profile'])->name('admin.profile');
        Route::get('/profile1', [HomeController::class, 'profile'])->name('admin.profile');

        Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::post('/profile/update-profile-image', [HomeController::class, 'updateProfileImage'])->name('admin.updateProfileImage');
        Route::get('/change-password', [HomeController::class, 'changePassword'])->name('admin.changePassword');
        Route::post('/change-password/store', [HomeController::class, 'changePasswordStore'])->name('admin.changePasswordStore');
        Route::post('/notification', [HomeController::class, 'newOrderNotification'])->name('admin.newOrderNotification');
        Route::post('/mark-as-read', [HomeController::class, 'markNotification'])->name('admin.markNotification');
        Route::get('/change-language/{lang}',[HomeController::class, 'changeLanguage'])->name('admin.changeLanguage');

        Route::group(['prefix' => 'users',], function () {
             #admin user Admin route
             Route::group(['prefix' => 'admin',], function () {
                Route::get('/', [AdminController::class, 'adminList'])->name('admin.adminList');
                Route::get('/create', [AdminController::class, 'createAdmin'])->name('admin.createAdmin');
                Route::post('/store', [AdminController::class, 'storeAdmin'])->name('admin.storeAdmin');
                Route::get('/view/{uuid}', [AdminController::class, 'viewAdmin'])->name('admin.viewAdmin');
                Route::get('/edit/{uuid}', [AdminController::class, 'editAdmin'])->name('admin.editAdmin');
                Route::post('/edit/{uuid}', [AdminController::class, 'updateAdmin'])->name('admin.updateAdmin');
                Route::delete('/delete/{id}', [AdminController::class, 'destroyAdmin'])->name('admin.destroyAdmin');
              });
            #admin user route
                Route::get('/', [ManageUserController::class, 'usersList'])->name('admin.usersList');
                Route::get('/view/{uuid}', [ManageUserController::class, 'viewUser'])->name('admin.viewUser');
                Route::get('/edit/{uuid}', [ManageUserController::class, 'editUser'])->name('admin.editUser');
                Route::post('/user-image/{uuid}', [ManageUserController::class, 'updateUserImage'])->name('admin.updateUserImage');
                Route::post('/edit/{uuid}', [ManageUserController::class, 'updateUser'])->name('admin.updateUser');
                Route::delete('/delete/{id}', [ManageUserController::class, 'destroyUser'])->name('admin.destroyUser');
                Route::get('/deleted-user-info', [ManageUserController::class, 'deletedUserInfo'])->name('admin.deletedUserInfo');
                Route::post('/restore-user', [ManageUserController::class, 'restoreDeletedUser'])->name('admin.restoreDeletedUser');
                Route::delete('/force-delete-user/{id}', [ManageUserController::class, 'forceDeleteUser'])->name('admin.forceDeleteUser');


                Route::post('/requestedDeleteUser', [ManageUserController::class, 'requestedDeleteUser'])->name('admin.requestedDeleteUser');
                Route::post('/multiple/delete/', [ManageUserController::class, 'destroyMultiUser'])->name('admin.destroyMultiUser');
                Route::post('/reject-delete-request', [ManageUserController::class, 'rejectDeleteRequest'])->name('admin.rejectDeleteRequest');

            #admin role route
            Route::group(['prefix' => 'role',], function () {
                Route::get('/', [ManageRoleController::class, 'index'])->name('admin.roleList');
                Route::get('/create', [ManageRoleController::class, 'create'])->name('admin.createRole');
                Route::post('/store', [ManageRoleController::class, 'store'])->name('admin.storeRole');
                Route::get('/show/{id}', [ManageRoleController::class, 'show'])->name('admin.showRole');
                Route::get('/edit/{id}', [ManageRoleController::class, 'edit'])->name('admin.editRole');
                Route::post('/update/{id}', [ManageRoleController::class, 'update'])->name('admin.updateRole');
                // Route::post('/destroy/{id}', [ManageRoleController::class, 'destroy'])->name('admin.destroyRole');
            });
        });

         //log routes for admin
         Route::group(['prefix' => 'log'], function () {
            #activity routes for log
            Route::group(['prefix' => 'admin',], function () {
              Route::get('/audit-logs', [ActivityController::class, 'auditLogs'])->name('admin.auditLogs');
              Route::get('/audit-export', [ActivityController::class, 'exportActivity'])->name('admin.exportActivity');
            });
          });


        Route::group(['prefix' => 'settings',], function () {
            #list type route
            Route::get('list-type', [LockupTypeController::class, 'index'])->name('admin.indexListType');
            Route::get('list-type/{id}', [LockupTypeController::class, 'show'])->name('admin.showListType');
            Route::post('list-item/store', [LockupController::class, 'store'])->name('admin.storeListItem');
            Route::post('list-item/update/{id}', [LockupController::class, 'update'])->name('admin.updateListItem');
            Route::post('list-item/destroy/{id}', [LockupController::class, 'destroy'])->name('admin.destroyListItem');
            #configuration route
            // Route::group(['prefix' => 'configuration',], function () {
            //     Route::get('/index', [ConfigurationController::class, 'index'])->name('admin.indexConfiguration');
            //     Route::post('/currency-setting', [ConfigurationController::class, 'currencyStore'])->name('admin.currencyStoreConfiguration');
            //     Route::post('/store-time-schedule', [ConfigurationController::class, 'storeStoreTimeSchedule'])->name('admin.storeTimeSchedule');
            //     Route::post('/store-payment-method', [ConfigurationController::class, 'paymentMethodStore'])->name('admin.paymentMethodStoreConfiguration');
            //     Route::post('/store-goole-map-api-key', [ConfigurationController::class, 'storeGoogleMapApiKey'])->name('admin.storeGoogleMapApiKey');
            //     Route::post('/store-product-location-radius', [ConfigurationController::class, 'storeProductLocationRadius'])->name('admin.storeProductLocationRadius');
            // });
        });
    }
);
