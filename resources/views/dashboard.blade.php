@extends('layouts/template')

@section('title')
    Dashboard Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $count_uuidcard }}</h3>

                        <p>UUID CARDS</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-credit-card fa"></i>
                    </div>
                    <a href="/uuid-cards" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $count_stages }}</h3>

                        <p>STAGES</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-rocket"></i>
                    </div>
                    <a href="/stages" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $count_routes }}</h3>

                        <p>ROUTES</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-map-signs"></i>
                    </div>
                    <a href="/categories" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ $count_categories }}</h3>

                        <p>CATEGORIES</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <a href="/categories" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>{{ $count_clubs }}</h3>

                        <p>CLUBS</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shield fa"></i>
                    </div>
                    <a href="/clubs" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-gray-active">
                    <div class="inner">
                        <h3>{{ $count_participants }}</h3>

                        <p>PARTICIPANTS</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="/participants" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $competition_type }}</h3>

                        <p>COMPETITION</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <a href="/settings" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="dashboard-center-text">Ultra Orienteering is your comfortable and reliable free tool to organize a single day or multi day orienteering competition. </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Participants who are not enrolled in a stage</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @if ($participants_without_stage->count() > 0 )
                            <table class="table table-hover">
                                <tr>
                                    <th width="70%">Participant Name</th>
                                    <th width="30%" class="center">UUID Card</th>
                                </tr>
                                @foreach($participants_without_stage as $check_participant)
                                    <tr>
                                        <td>{{ $check_participant->participant_name }}</td>
                                        <td class="center">#{{ $check_participant->uuidcard->id }} ({{ $check_participant->uuidcard->uuid_name }})</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <br />
                            <div class="center">No participants found in database.</div>
                            <br />
                        @endif
                        <div class="center"><?php echo $participants_without_stage->render(); ?></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">BEST TIME</span>
                        <span class="info-box-number dashboard-counts">{{ $best_time }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">LONGEST TIME</span>
                        <span class="info-box-number dashboard-counts">{{ $longest_time }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>
                    </div>
                    <div class="box-body">
                        @if($categories_list->count() > 0)
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 30%">Category Name</th>
                                    <th style="width: 50%">Route</th>
                                </tr>
                                @foreach($categories_list as $category)
                                    <tr>
                                        <td>{{ $number_categories++ }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            {{ $category->route->route_name }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="center">No categories found in database.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection