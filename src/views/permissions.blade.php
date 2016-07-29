@extends('app')

@section('content')
    <h2>İzin Yönetimi</h2>
    <div class="row" ng-controller="permissionsController">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">İzinler</span>
                </div>
                <div class="panel-body">
                    <form action="/api/save-permissions" method="post">
                    <table class="table table-striped">
                    <tr>
                        <th>İzin Adı</th>
                        @foreach($roles as $role)
                            <th>{{$role->display_name}}</th>
                        @endforeach
                    </tr>
                        @foreach($permissions as $key=>$permission)
                            <tr>
                                <td>
                                   {{$permission['display_route']}}
                                </td>
                                @foreach($roles as $role)
                                    <td>
                                        <input class="permission-checkbox" type="checkbox" name="permissions[{{$role->name}}][{{$key}}]"
                                                @if(is_array($enabled_permissions[$role->name]) && in_array($permission['route'], $enabled_permissions[$role->name]))
                                                    checked
                                                @endif
                                                value="{{$permission['route']}}"
                                                >
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="btn btn-primary">
                            Kaydet
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="/js/permissions.js"></script>
@endsection