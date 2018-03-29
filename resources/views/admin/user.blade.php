@extends('layouts.app')

@section('title', 'Manage User')

@section('header')
<nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                      <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="/admin/users"><i class="fa fa-users"></i> User</a></li>
                        <li><a href="/admin/manage-gps"><i class="fa fa-cubes"></i> Manage Gps</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user"></i>    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                  <!--   <li><a href="/profile">Profile</a></li> -->
                                    <li>
                                        <a href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                             <i class="fa fa-sign-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
@endsection

@section('content')
<div class="container" ng-controller="adminUserController">

        <div class="col-md-6 col-md-offset-3" >
            <div class="panel-group">
                 <div class="panel panel-primary animated" ng-show="showFormAdd" id="userAdd">
                <div class="panel-heading">Add Data Gps</div>
                <div class="panel-body">
                   <div class="col-md-10">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-md-4">Username</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="new.username" placeholder="Enter username" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" ng-model="new.email" placeholder="Enter email" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Password</label>
                                 <div class="col-md-8">
                                    <input type="password" class="form-control" ng-model="new.password" placeholder="Enter password" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Retype Password</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" ng-model="new.retypePsw" placeholder="Enter retype password" required="true">
                                </div>
                            </div>
                            
                            <br>
                            <div class="form-group">
                              <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" ng-click="addDataUser()"><i class="fa fa-paper-plane"></i> Save</button>
                                    <button class="btn btn-danger" ng-click="hideAddform()"><i class="fa fa-arrow-left"></i> Cancel</button>
                              </div>
                            </div>
                        </form>
                   </div>
                </div>
            </div><!-- end Panel Add data -->
            <div class="panel panel-success animated" id="userUpdate" ng-show="showFormUpdate">
                <div class="panel-heading">Update Data Gps</div>
                <div class="panel-body">
                        <div class="col-md-10">
                        <form class="form-horizontal">
                            <input type="text" ng-model="old.id" hidden>
                            <div class="form-group">
                                <label for="" class="col-md-4">Username</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="old.username" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" ng-model="old.email" required="true">
                                </div>
                            </div>
                            
                            <br>
                            <div class="form-group">
                              <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" ng-click="updateDataUser()"><i class="fa fa-paper-plane"></i> Save</button>
                                    <button class="btn btn-danger" ng-click="hideUpdateform()"><i class="fa fa-arrow-left"></i> Cancel</button>
                              </div>
                            </div>
                        </form>
                   </div>
                </div>
            </div> <!-- end Panel Update data -->
            </div>
        </div> 
        <br>
        <br>

    <div class="row">
        <div class="col-md-12">
            
            <!-- <h2>This is page manage gps</h2> -->

            <button class="btn btn-primary" ng-click="showAddForm()"><i class="fa fa-plus"></i> Add Data</button>
            <br><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="user in data">
                        <td>@{{ $index }}</td>
                        <td>@{{ user.name }}</td>
                        <td>@{{ user.email }}</td>
                        <td>
                            <button class="btn btn-success" ng-click="showUpdateForm($index)"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger" ng-click="deleteDataUser($index)"><i class="fa fa-trash"></i> Delete</button>
                            <input type="text" class="token" data-token="{{csrf_token()}}" hidden>
                        </td>
                    </tr>
                </tbody>
            </table>

        <div class="modal fade" id="detailGps" role="dialog">
            <div class="modal-dialog">
                
                  <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px; text-align: center;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Detail Data</h4>
                        <hr>
                    </div>

                    <div class="modal-body" style="padding:40px 50px;">
                            <div class="row">   
                                <div class="col-md-3">
                                    <p><strong>Buy Date</strong></p>
                                </div>
                                <div class="col-md-8">
                                    <dt>: <i>@{{detail.buy_date}}</i></dt>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-3">
                                    <p><strong>Sold Date</strong></p>
                                </div>
                                <div class="col-md-8">
                                    <dt>: @{{detail.sold_date}}</dt>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-3">
                                    <p><strong>Sold To</strong></p>
                                </div>
                                <div class="col-md-8">
                                    <dt>: @{{detail.sold_to}}</dt>
                                </div>
                            </div>
                             <div class="row">   
                                <div class="col-md-3">
                                    <p><strong>Deskripsi</strong></p>
                                </div>
                                <div class="col-md-8">
                                    <dt>: @{{detail.description}}</dt>
                                </div>
                            </div>
                        
                    </div>
                </div>
              
            </div>
        </div>
        </div>

    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">

    // Setup Controller
    angular.module('app').controller('adminUserController', ($scope, $http) => {


        // Setup Callback function for addClass
        var oAddClass = $.fn.addClass;
        $.fn.addClass = function () {
            for (var i in arguments) {
                var arg = arguments[i];
                if ( !! (arg && arg.constructor && arg.call && arg.apply)) {
                    arg();
                    delete arg;
                }
            }
            return oAddClass.apply(this, arguments);
        }

        // Hide Form Add and Update Gps
        $scope.showFormAdd = false;
        $scope.showFormUpdate = false;

        // Show Form Add Gps
        $scope.showAddForm = () => {

            $("#userAdd").addClass("bounceInDown", () => {
                $scope.showFormUpdate = false;
                $scope.showFormAdd = true;
            });

            setTimeout(function() {
                $("#userAdd").removeClass("bounceInDown");
            }, 1000);
            
        };

        // Hide Form Update Gps
        $scope.hideAddform = () => {
            $scope.showFormAdd = false;
        };

        // Show Form Update Gps
        $scope.showUpdateForm = id => {            

            let data = $scope.data[id];

            // Add old data to form input
            $scope.old.id = data.id;
            $scope.old.username = data.name;
            $scope.old.email = data.email;

            $("#userUpdate").addClass("bounceInDown", () => {
               $scope.showFormAdd = false;
               $scope.showFormUpdate = true;
            });

        };

        // Hide Form Add Gps
        $scope.hideUpdateform = () => {
            $scope.showFormUpdate = false;             
        };

        // Get All Data Gps
        $scope.getData = () => {

            // Get Data with AJAX
            $http.get('/admin/getAllUser').then( response => {
                $scope.data = response.data;
            })
        }

        // Load Data Gps
        $scope.getData();

        // Create new data gps
        $scope.new = {};
        $scope.addDataUser = () => {

            let data = $scope.new;
            console.log(data);

            let fd = new FormData();

            if ($scope.new.password != $scope.new.retypePsw) {
                swal(
                  'Error!',
                  'Password and Retype Password does not match!',
                  'error'
                )
            } else {
                // Send To database with AJAX
                for(var key in data)
                    fd.append(key, data[key]);
                $http({
                    transformRequest:angular.identity,
                    headers : {'Content-Type': undefined},
                    method  : 'POST',
                    url     : '/admin/createUser',
                    data    : fd
                }).then((response) =>{

                    // Callback if data successfully created
                    $scope.showFormAdd = false;
                    $scope.new = {};

                    // Refresh Data Gps
                    $scope.getData();

                    swal(
                      'Success!',
                      'New user has been created!',
                      'success'
                    )
                });
            }

            
        };

        // Update data gps
        $scope.old = {}
        $scope.updateDataUser = () => {

            // Define form input data
            let data = $scope.old;
            console.log(data);

            let fd = new FormData();

            // Send To database with AJAX
            for(var key in data)
                fd.append(key, data[key]);
            $http({
                transformRequest:angular.identity,
                headers : {'Content-Type': undefined},
                method  : 'POST',
                url     : '/admin/updateUser',
                data    : fd
            }).then((response) =>{

                // Callback if data successfully created
                $scope.showFormUpdate = false;

                // Refresh Data Gps
                $scope.getData();

                swal(
                  'Success!',
                  'User has been updated!',
                  'success'
                )
            });

        };

        // Delete Data Gps
        $scope.deleteDataUser = id => {

            // Get ID from index array data gps
            let data  = $scope.data[id];

            // Confirmation if user want delete this data
            swal({
              title: 'Are you sure?',
              text: "Delete Data User!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {

                $http({
                    method  : 'DELETE',
                    url     : '/admin/deleteUser/' + data.id
                }).then(() => {
                    // Callback if data successfully deleted
                        swal(
                      'Deleted!',
                      'User has been deleted.',
                      'success'
                    )

                    // Refresh Data Gps
                    $scope.getData();
                });
                
              }
            });
        }



    });
</script>
@endsection