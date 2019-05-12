@extends('layouts/template')
@section('title') Rankings Categories Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Rankings for Stage {{ $stage->stage_name }}
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/rankings">Rankings</a></li>
            <li><a href="#">Stage {{ $stage->stage_name }}</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-left">
                        <a href="/rankings" class="btn btn-primary pull-left"><i class="fa  fa-mail-reply"></i> BACK </a>
                    </span>
                </h1>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="stages table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center" style="width: 10%">#</th>
                                <th class="center">Category Name</th>
                                <th class="center">No. Participants</th>
                                <th class="center" style="width: 20%">Actions</th>
                            </tr>
                            @foreach($categories as $category)
                                <tr class="stages-list-{{ $category->id }}">
                                    <td class="center category-id-{{ $category->id }}">{{ $number++ }}</td>
                                    <td class="category-name-{{ $category->id }}">{{ $category->category_name }}</td>
                                    <td class="center no-participants-{{ $category->id }}">
                                        <?php
                                        $participants_count = DB::table('participant_stages')->where('stages_id', '=', $stage->id )->where('categories_id', '=', $category->id )->count();
                                        echo $participants_count;
                                        ?>
                                    </td>
                                    <td class="center">
                                        <a class="btn btn-success btn-flat margin @if($participants_count == 0)disabled @endif" data-id="{{ $category->id }}" href="/rankings/{{ $stage->id }}/view/{{ $category->id }}/ranking">View Rankings</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection