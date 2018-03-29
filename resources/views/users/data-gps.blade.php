@extends('layouts.app')

@section('title', 'Manage Gps User')

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
                        <li><a href="{{ url('/data-gps') }}"><i class="fa fa-cubes"></i> Manage GPS</a></li>
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
                                    <li><a href="{{ url('/profile') }}"><i class="fa fa-address-book"></i> Profile</a></li>
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
<div class="container" ng-controller="userController">

        <div class="col-md-6 col-md-offset-3" >
            <div class="panel-group">
                 <div class="panel panel-primary animated" id="addGpsUser" ng-show="showFormAdd">
                <div class="panel-heading">Add Data Gps</div>
                <div class="panel-body">
                   <div class="col-md-10">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-md-4">Brand Gps</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="new.brand" placeholder="Enter brand gps">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Model Gps</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="new.model" placeholder="Enter model gps">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Nama Gps</label>
                                 <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="new.name" placeholder="Enter nama gps">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Garansi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="new.garansi" placeholder="Enter garansi gps">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Buy Date</label>
                                <div class="col-md-8">
                                    <div class='input-group'>
                                        <input type='text' class="form-control form_datetime" ng-model="new.buyDate" placeholder="Enter buy date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Sold Date</label>
                                <div class="col-md-8">
                                    <div class='input-group'>
                                        <input type='text' class="form-control form_datetime" ng-model="new.soldDate" placeholder="Enter sold date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Sold To</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="new.soldTo" placeholder="Enter Sold to">
                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="" class="col-md-4">Photo</label>
                                 <div class="col-md-8">
                                     <input type="file" file-model="new.file"/>
                                 </div>
                            </div>
                            <div class="form-group">
                                 <label for="" class="col-md-4">Deskripsi</label>
                                 <div class="col-md-8">
                                     <textarea class="form-control" ng-model="new.desc" cols="10" rows="5"></textarea>
                                 </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" ng-click="addDataGps()"><i class="fa fa-paper-plane"></i> Save</button>
                                    <button class="btn btn-danger" ng-click="hideAddform()"><i class="fa fa-arrow-left"></i> Cancel</button>
                              </div>
                            </div>
                        </form>
                   </div>
                </div>
            </div><!-- end Panel Add data -->
            <div class="panel panel-success animated" id="updateGpsUser" ng-show="showFormUpdate">
                <div class="panel-heading">Update Data Gps</div>
                <div class="panel-body">
                        <div class="col-md-10">
                        <form class="form-horizontal">
                            <input type="text" ng-model="old.id" hidden>
                            <div class="form-group">
                                <label for="" class="col-md-4">Brand Gps</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="old.brand">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Model Gps</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="old.model">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Nama Gps</label>
                                 <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="old.name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Garansi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="old.garansi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Buy Date</label>
                                <div class="col-md-8">
                                    <div class='input-group'>
                                        <input type='text' class="form-control form_datetime" ng-model="old.buyDate" placeholder="Enter buy date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Sold Date</label>
                                <div class="col-md-8">
                                    <div class='input-group'>
                                        <input type='text' class="form-control form_datetime" ng-model="old.soldDate" placeholder="Enter sold date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4">Sold To</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="old.soldTo" placeholder="Enter Sold to">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="" class="col-md-4">Photo</label>
                                <div class="col-md-8">
                                    <input type="file" file-model="old.file">
                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="" class="col-md-4">Deskripsi</label>
                                 <div class="col-md-8">
                                     <textarea class="form-control" ng-model="old.desc" cols="10" rows="5"></textarea>
                                 </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" ng-click="updateDataGps()"><i class="fa fa-paper-plane"></i> Save</button>
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
                        <th>Brand Gps</th>
                        <th>Model Gps</th>
                        <th>Gps Name</th>
                        <th>Waranty Month</th>
                        <th>Photo</th>
                        <th>Detail</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="gps in data">
                        <td>@{{ $index }}</td>
                        <td><strong><i>@{{ gps.brand_gps }}</i></strong></td>
                        <td>@{{ gps.model_gps }}</td>
                        <td>@{{ gps.gps_name }}</td>
                        <td>@{{ gps.waranty_month }} bulan</td>
                        <td><img ng-src="http://localhost:8000/image/@{{gps.photo}}" alt="" width="50px" height="50px"></td>
                        <td><button class="btn btn-info" ng-click="showDetail($index)"><i class="fa fa-external-link"></i> Detail</button></td>
                        <td>
                            <button class="btn btn-success" ng-click="showUpdateForm($index)"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger" ng-click="deleteDataGps($index)"><i class="fa fa-trash"></i> Delete</button>
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
                                    <dt>: <i>@{{detail.sold_date}}</i></dt>
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

    // Setup Image Upload With angular
    angular.module('app').directive('fileModel', ['$parse', $parse => {
        return {
            restrict: 'A',
            link: (scope, elm, attrs) => {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;
                elm.bind('change', () => {
                    scope.$apply(() =>{
                        modelSetter(scope, elm[0].files[0])
                    })
                })
            }
        }
    }]);

    // Setup Controller
    angular.module('app').controller('userController', ($scope, $http) => {

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
            $("#addGpsUser").addClass("bounceInRight", () => {
                $scope.showFormUpdate = false;
                $scope.showFormAdd = true;
            });
        };

        // Show Form Update Gps
 
        $scope.showUpdateForm = id => {
              

            let data = $scope.data[id];
            /*console.log(data);*/

            // Add old data to form input
            $scope.old.id = data.id;
            $scope.old.brand = data.brand_gps;
            $scope.old.model = data.model_gps;
            $scope.old.name = data.gps_name;
            $scope.old.garansi = data.waranty_month;
            $scope.old.buyDate = data.buy_date;
            $scope.old.soldDate = data.sold_date;
            $scope.old.soldTo = data.sold_to;
            $scope.old.desc = data.description;

            $("#updateGpsUser").addClass("bounceInDown", () => {
               $scope.showFormAdd = false;
                $scope.showFormUpdate = true;
            });

        };

        // Show Detail
        $scope.showDetail = id => {
            $scope.detail = $scope.data[id];

            $("#detailGps").modal("show");
        }

        // Hide Form Add Gps
        $scope.hideUpdateform = () => {
             $scope.showFormUpdate = false;
        };

        // Hide Form Update Gps
        $scope.hideAddform = () => {
             $scope.showFormAdd = false;
        };

        // Get All Data Gps
        $scope.getData = () => {
            // Get Data with AJAX
            $http.get('/getDataGps').then( response => {
                $scope.data = response.data;
            })
        }

        // Load Data Gps
        $scope.getData();

        // Create new data gps
        $scope.new = {};
        $scope.addDataGps = () => {

            let data = $scope.new;

            let fd = new FormData();

            // Send To database with AJAX
            for(var key in data)
                fd.append(key, data[key]);
            $http({
                transformRequest:angular.identity,
                headers : {'Content-Type': undefined},
                method  : 'POST',
                url     : '/createData',
                data    : fd
            }).then((response) =>{

                // Callback if data successfully created
                $scope.showFormAdd = false;
                $scope.new = {};

                // Reload Data Gps
                $scope.getData();

                swal(
                  'Success!',
                  'Data gps berhasil dibuat!',
                  'success'
                )
            });

            
        };

        // Update data gps
        $scope.old = {}
        $scope.updateDataGps = () => {

            // Define form input data
            let data = $scope.old;

            let fd = new FormData();

            // Send To database with AJAX
            for(var key in data)
                fd.append(key, data[key]);
            $http({
                transformRequest:angular.identity,
                headers : {'Content-Type': undefined},
                method  : 'POST',
                url     : '/updateData',
                data    : fd
            }).then((response) =>{

                // Callback if data successfully created
                $scope.showFormUpdate = false;

                // Reload Data Gps
                $scope.getData();

                swal(
                  'Success!',
                  'Data gps berhasil diubah!',
                  'success'
                )
            });

        };

        // Delete Data Gps
        $scope.deleteDataGps = id => {

            // Get ID from index array data gps
            let data  = $scope.data[id];

            // Confirmation if user want delete this data
            swal({
              title: 'Are you sure?',
              text: "Delete Data Gps!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {

                $http({
                    method  : 'DELETE',
                    url     : '/deleteDataGps/' + data.id
                }).then(() => {
                    // Callback if data successfully deleted
                        swal(
                      'Deleted!',
                      'Your Data has been deleted.',
                      'success'
                    )

                    // Reload Data Gps
                    $scope.getData();
                });
                
              }
            });
        }



    });
</script>
@endsection