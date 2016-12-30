@extends('layouts/template')

@section('title')
    Dashboard Ultra Orienteering Software - Open Source Software
    @endsection

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-group fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $clubs }}</div>
                            <div>Clubs</div>
                        </div>
                    </div>
                </div>
                <a href="/clubs">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $participants }}</div>
                            <div>Participants</div>
                        </div>
                    </div>
                </div>
                <a href="/participants">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-space-shuttle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $stages }}</div>
                            <div>Stages</div>
                        </div>
                    </div>
                </div>
                <a href="/stages">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-sitemap fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $categories }}</div>
                            <div>Categories</div>
                        </div>
                    </div>
                </div>
                <a href="/categories">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="space"></div>

    <div class="center">Ultra Orienteering is your comfortable and reliable free tool to organise a single day or multi day orienteering competition. </div>

    <div class="space"></div>

    <div class="col-xs-12 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Routes in database
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        @if (count($routelist) > 0 )
                            <thead>
                            <tr>
                                <th class="center">ID</th>
                                <th class="center">Route Name</th>
                                <th class="center">Length in Km</th>
                                <th class="center">Number of Posts</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($routelist as $route)
                                <tr>
                                    <td class="center">{{ $route->id }}</td>
                                    <td class="center">{{ $route->name }}</td>
                                    <td class="center">{{ $route->length_in_km }} km</td>
                                    <td class="center">{{ $route->post_amount }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        @else
                            <div class="center">No routes found in database, please add.</div>
                        @endif
                    </table>
                    <div  class="center"> {{ $routelist->links() }}</div>

                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

    <div class="col-xs-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="text-center">
                        <div class="hugeuuid">{{ $uuidcard }}</div>
                    </div>
                </div>
            </div>
            <a href="/participants">
                <div class="panel-footer">
                   <div class="center"> UUID Cards in database</div>
                </div>
            </a>
        </div>
    </div>


    <div class="col-xs-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="text-center">
                        <div class="hugeuuid">{{ $participantmanager }}</div>
                    </div>
                </div>
            </div>
            <a href="/uuid-cards">
                <div class="panel-footer">
                    <div class="center"> Participants in Stages</div>
                </div>
            </a>
        </div>
    </div>

    @endsection