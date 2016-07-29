<?php namespace App\Http\Middleware;

use App\Permission;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class RoleChecker {

	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth,Route $route)
	{
		$this->auth = $auth;
		$this->route = $route;
	}
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(!Permission::where('route',$this->route->getActionName())->whereIn('roles_id',Auth::user()->role()->lists('id'))->exists()){
			return response('Unauthorized.', 401);
		}
		return $next($request);
	}

}
