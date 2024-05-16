<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManageRoleController;
use App\Http\Controllers\ManageUserController;

Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'dataTable',
    ],

    function () {
        Route::get('/user-list-table', [ManageUserController::class, 'dataTableUsersListTable'])->name('dataTable.dataTableUsersListTable');
        Route::get('/user-list-table', [ManageCustomerController::class, 'dataTableUsersListTable'])->name('dataTable.dataTableCustomersListTable');
        Route::get('/roles-list-table', [ManageRoleController::class, 'dataTableRolesListTable'])->name('dataTable.dataTableRolesListTable');
        Route::get('/roles-list-table', [AdminController::class, 'dataTableAdminsListTable'])->name('dataTable.dataTableAdminsListTable');
    }

);
