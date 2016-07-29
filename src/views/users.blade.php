@extends('app')

@section('content')
    <h2>Kullanıcı Yönetimi</h2>
    <div class="row" ng-controller="usersController">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Kullanıcı Oluştur</span>
                </div>
                <div class="panel-body">
                    <form class="form" id="newUser" ng-submit="saveUser()">
                        <div class="form-group">
                            <label for="username">Kullanıcı Adı</label>
                            <div class="input-group">
                                <input class="form-control" name="username" id="username" ng-model="newUser.username">
                                <span class="input-group-addon">@boun.edu.tr</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Yetki</label>
                                <select ng-model="newUser.role" id="role" class="form-control">
                                    @foreach(\App\Role::all() as $role)
                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Oluştur">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Kullanıcılar</span>
                </div>
                <div class="panel-body">
                    <table ng-table="tableParams" class="table-responsive table table-striped">
                        <tr ng-repeat="row in $data track by row.id">
                            <td data-title="'Kullanıcı Adı'" filter="{username: 'text'}" sortable="'username'">
                                @{{ row.username }}
                            </td>
                            <td data-title="'Adı'" filter="{firstname: 'text'}" sortable="'firstname'">
                                @{{ row.firstname }}
                            </td>
                            <td data-title="'Soyadı'" filter="{lastname: 'text'}" sortable="'lastname'">
                                @{{ row.lastname }}
                            </td>
                            <td data-title="'Dahili'" filter="{dahili: 'text'}" sortable="'dahili'">
                                @{{ row.dahili }}
                            </td>
                            <td data-title="'Son Görüldü'" filter="{last_login: 'text'}" sortable="'last_login'">
                                @{{ row.last_login }}
                            </td>
                            <td data-title="'Yetki'" filter="{filter_yetkiler: 'select'}" filter-data="filter_yetkiler">
                                <a href="#" editable-checklist="row.yetki" e-ng-options="y.id as y.display_name for y in yetkiler" onaftersave="updateYetki(row.id,row.yetki)">
                                    @{{ showStatus(row.yetki) }}
                                </a>
                            </td>

                            <!--<td ng-repeat="field in $columns track by $index">
                                @{{ row[field.field] }}
                            </td>-->
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="/js/users.js"></script>
@endsection