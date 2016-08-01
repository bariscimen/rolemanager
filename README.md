# rolemanager
Manage role permissions for all routes.

The biggest advantage of the package is it loads all the routes for you and you can specify per role per route permissions without defining them.

# Installation
composer require tanmuhittin/rolemanager

add 
'Tanmuhittin\Rolemanager\RolemanagerServiceProvider'
to providers array in config\app.php

php artisan vendor:publish

php artisan migrate

copy vendor\tanmuhittin\rolemanager\src\Middleware\RoleChecker.php to app\Http\Middleware folder

add following lines to User.php

	public function role(){
		return $this->belongsToMany('App\Role','users_roles','user_id','role_id');
	}
	public function getYetkiAttribute(){
		return $this->role()->lists('id');
	}
	
you are done. You have 3 pages to manage permissions and roles ann users. These are 
	/tanmuhittin/manage-users
	/tanmuhittin/manage-roles
	/tanmuhittin/manage-permissions
You can change the route prefix in the routes.php file. If you would like to use your own prefix just add 
	Route::group(['before' => 'auth', 'prefix' => 'tanmuhittin'], function () {
	    Route::controller('/', 'Tanmuhittin\Rolemanager\RoleController');
	});
to your routes.php with the profix you like.

The package has some javascript dependencies too. These are jquery, angularjs ng-table, angular-resource, xeditable
	<script src="/bower_components/jquery/dist/jquery.js"></script>
	<script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="/bower_components/angular/angular.js"></script>
	<script src="/bower_components/ng-table/dist/ng-table.js"></script>
	<script src="/bower_components/angular-resource/angular-resource.js"></script>
	<script src="/bower_components/angular-xeditable/dist/js/xeditable.js"></script>

	
	
