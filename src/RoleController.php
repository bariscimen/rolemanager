<?php namespace Tanmuhittin\Rolemanager;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RoleController extends Controller
{

    public function getManageUsers(){
        return view('pages.admin.users');
    }
    public function getManageRoles(){
        return view('pages.admin.roles');
    }
    public function getManagePermissions(){
        $roles=Role::all();
        $routes = Route::getRoutes();
        $permissions=array();
        $route_list=array();
        $enabled_permissions=array();
        foreach($roles as $role){
            $enabled_permissions[$role->name]=$role->permissions()->lists('route');
        }
        foreach($routes as $route)
        {
            if(in_array($route->getActionName(),$route_list))
                continue;
            $route_list[]=$route->getActionName();
            $permissions[]=array(
                'route'=>$route->getActionName(),
                'display_route'=>str_replace('App\Http\Controllers\\','',$route->getActionName())
            );
        }
        return view('pages.admin.permissions',compact('permissions','roles','enabled_permissions'));
    }
    public function getUsers(Request $request){
        $yetkiler=Role::all();
        $count=$request->get('count');
        $page=$request->get('page');
        $filters=$request->get('filter');
        $sorting=$request->get('sorting');
        $results=new User;
        if(is_array($filters)){
            foreach($filters as $key=>$filter){
                $results=$results->where($key,'like',"%".urldecode($filter)."%");
            }
        }
        if(is_array($sorting)){
            foreach($sorting as $key=>$sort){
                $results=$results->orderBy($key,$sort);
            }
        }else{
            $results=$results->orderBy('id','desc');
        }
        if($request->has('count') && $request->has('page')){
            $results = $results->skip($count*($page-1))->take($count);
        }
        $results=$results->get();
        $filter_yetkiler=Role::select('id','display_name as title')->get();
        return array(
            'results'=>$results,
            'inlineCount'=>User::count(),//$table::count(),
            'yetkiler'=>$yetkiler,
            'filter_yetkiler'=>$filter_yetkiler
        );
    }
    public function postSavePermissions(Request $request){
        //return $request->all();
        $permissions=$request->get('permissions');
        Permission::truncate();
        foreach($permissions as $role=>$perms){
            foreach($perms as $perm){
                $permission=new Permission;
                $permission->roles_id=Role::where('name',$role)->first()->id;
                $permission->route=$perm;
                $permission->save();
            }
        }
        return back();
    }

    public function postUpdateRoles(Request $request, $user_id){
        $user=User::find($user_id);
        $user->role()->sync($request->all());
        return 1;
    }

}
