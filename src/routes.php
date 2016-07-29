<?php

Route::group(['before' => 'auth', 'prefix' => 'tanmuhittin'], function () {
    Route::controller('/', 'Tanmuhittin\Rolemanager\RoleController');
});