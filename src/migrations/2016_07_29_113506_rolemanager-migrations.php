<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolemanagerMigrations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->unique();
			$table->string('display_name', 255)->nullable();
			$table->string('description', 255)->nullable();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

			$table->foreign('roles_id')->references('id')->on('roles');
		});
		Schema::create('users_roles', function(Blueprint $table) {
			$table->integer('user_id')->unsigned();
			$table->integer('role_id')->unsigned();

			$table->foreign('roles_id')->references('id')->on('roles');
		});
		Schema::create('permissions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('route', 255)->nullable();
			$table->integer('roles_id')->unsigned();

			$table->foreign('roles_id')->references('id')->on('roles');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
		Schema::drop('user_roles');
		Schema::drop('permissions');
	}

}
