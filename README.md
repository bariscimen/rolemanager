# rolemanager
Manage role permissions for all routes

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
	You can change the route prefix in the routes.php file
	
	
