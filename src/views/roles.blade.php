@extends('app')

@section('content')
    <h2>Rol Yönetimi</h2>
    <div class="row" ng-controller="rolesController">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Rol Oluştur</span>
                </div>
                <div class="panel-body">
                    <form class="form" id="newUser" ng-submit="saveRole()">
                        <div class="form-group">
                            <label for="name">Kısa Adı</label>
                                <input class="form-control" name="name" id="name" ng-model="newRole.name">
                                <label class="alert-danger">@{{ errors.name[0] }}</label>
                        </div>
                        <div class="form-group">
                            <label for="display_name">Adı</label>
                            <input class="form-control" name="display_name" id="display_name" ng-model="newRole.display_name">
                            <label class="alert-danger">@{{ errors.display_name[0] }}</label>
                        </div>
                        <div class="form-group">
                            <label for="description">Tanımı</label>
                            <input class="form-control" name="description" id="description" ng-model="newRole.description">
                            <label class="alert-danger">@{{ errors.description[0] }}</label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Oluştur">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Roller</span>
                </div>
                <div class="panel-body">
                    <table ng-table-dynamic="tableParams with cols" class="table-responsive table table-striped">
                        <tr ng-repeat="row in $data track by row.id">
                            <td ng-repeat="field in $columns track by $index">
                                @{{ row[field.field] }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="/js/roles.js"></script>
@endsection