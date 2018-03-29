@extends('layouts.app')

@section('title', 'Profile')

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
                    <a class="navbar-brand" href="{{ url('/home') }}">
                       <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/data-gps') }}"><i class="fa fa-cubes"></i>  Manage GPS</a></li>
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
                                   <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                     <li><a href="/profile"><i class="fa fa-address-book"></i> Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
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
<div class="container" ng-controller="profile">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default" ng-show="myProfile">
                <div class="panel-heading">My profile</div>

                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5><strong>My Name</strong></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>: @{{ name }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h5><strong>My Email</strong></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>: {{ Auth::user()->email }}</h5>
                            </div>
                        </div>  
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-info btn-block" ng-click="profile()"><i class="fa fa-address-card"></i> Change Name</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-info btn-block" ng-click="password()"><i class="fa fa-eye"></i> Change Password</button>
                            </div>
                        </div>            
                  
                </div>
            </div>

            <div class="panel panel-primary animated" id="profile" ng-show="formProfile">
                <div class="panel-heading"><strong>Change Name</strong></div>

                <div class="panel-body">
                    <div class="col-md-8">
                        
                        <form class="form-horizontal">
                            <br>
                            <div class="form-group">
                                <label for="" class="col-md-4">New Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="name">
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <div class="row">
                                       <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-block" ng-click="changeProfile({{Auth::user()->id}})"><i class="fa fa-paper-plane"></i> Save</button>
                                       </div>
                                       <div class="col-md-6">
                                          <button class="btn btn-danger btn-block" ng-click="hideProfile()"><i class="fa fa-arrow-left"></i> cancel</button>
                                       </div>
                                   </div>
                                </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
            </div>

            <div class="panel panel-primary animated" id="password" ng-show="formPassword">
                <div class="panel-heading"><strong>Change Password</strong></div>

                <div class="panel-body">
                    <div class="col-md-8">
                        
                        <form class="form-horizontal">
                            <br>
                            <div class="form-group">
                               <!--  <label for="" class="col-md-4">Old Password</label>
                               <div class="col-md-8">
                                   <input type="password" class="form-control" ng-model="new.oldPassword">
                               </div> -->
                            </div> 
                            <div class="form-group">
                                <label for="" class="col-md-4">New Password</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" ng-model="new.newPassword" placeholder="Enter New Password">
                                </div>
                            </div> 
                            <div class="form-group">
                              <label for="" class="col-md-4">Retype Password</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" ng-model="new.retypePassword" placeholder="Enter Retype Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                   <div class="row">
                                       <div class="col-md-6">
                                            <button class="btn btn-primary btn-block" ng-click="changePassword({{Auth::user()->id}})"><i class="fa fa-paper-plane"></i> Save</button>
                                       </div>
                                       <div class="col-md-6">
                                           <button class="btn btn-danger btn-block" ng-click="hidePassword()"><i class="fa fa-arrow-left"></i> cancel</button>
                                       </div>
                                   </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    angular.module('app').controller('profile', ($scope, $http) => {
        
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

        $scope.myProfile = true;

        $scope.profile = () => {
            $("#profile").addClass("zoomInDown", () => {
                $scope.myProfile = false;
                $scope.formPassword = false;
                $scope.formProfile = true;
            });
        }

        $scope.hideProfile = () => {
            $scope.formProfile = false;
            $scope.myProfile = true;
        }

        $scope.hidePassword = () => {
            $scope.formPassword = false;
            $scope.myProfile = true;
        }
        
        $scope.password = () => {
            $("#password").addClass("zoomInUp", () => {
                $scope.myProfile = false;
                $scope.formProfile = false;
                $scope.formPassword = true;
            });
            
        }

        $scope.getName = () => {
            $http.get('/getName').then((response) =>{
                $scope.name = response.data.name;
            })
        }

        $scope.getName();

        $scope.changeProfile = id => {

            let data = {
                id : id,
                name : $scope.name
            }

            $http.post('/changeName', data).then(() => {
                console.log("name was successfully created");
                /*$scope.name = "";*/
                swal(
                  'Success!',
                  'Name was successfully updated!',
                  'success'
                )
                $scope.getName();
                $scope.formProfile = false;
                $scope.myProfile = true;
            })
        }

        $scope.new = {};
        $scope.changePassword = id => {
           /* console.log($scope.new);*/

            // Check if new password match with retype password
            if ($scope.new.newPassword != $scope.new.retypePassword) {
                swal(
                  'Error!',
                  'New password and Retype Passwod does not match',
                  'error'
                )
            } else {
                let data = {
                    id : id,
                    newPassword : $scope.new.newPassword
                }

                $http.post('/changePassword', data).then(() => {
                    swal(
                      'Success!',
                      'Password was successfully updated!',
                      'success'
                    )

                    $scope.new = {};
                    $scope.formPassword = false;
                    $scope.myProfile = true;
                })
            }
        }

    })
</script>
@endsection