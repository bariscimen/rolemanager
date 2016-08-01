<?php namespace Tanmuhittin\Rolemanager;

use Illuminate\Support\ServiceProvider;

class RolemanagerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		include __DIR__.'/routes.php';
		$this->app->make('Tanmuhittin\Rolemanager\RoleController');
		$this->publishes([
			__DIR__.'/views' => base_path('resources/views/pages/admin'),
		],'views');
		$this->publishes([
			__DIR__.'/assets' => public_path('/'),
		], 'assets');
		$this->publishes([
			__DIR__.'/migrations' => database_path('migrations')
		], 'migrations');
		$this->publishes([
			__DIR__.'/models' => base_path('app')
		], 'models');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}