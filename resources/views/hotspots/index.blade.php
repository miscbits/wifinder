@extends('dashboard', ['pageTitle' => '_camelUpper_casePlural_ &raquo; Index'])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right raw-margin-top-24 raw-margin-left-24">
                {!! Form::open(['route' => 'hotspots.search']) !!}
                <input class="form-control form-inline pull-right" name="search" placeholder="Search">
                {!! Form::close() !!}
            </div>
            <h1 class="pull-left">Hotspots</h1>
            <a class="btn btn-primary pull-right raw-margin-top-24 raw-margin-right-8" href="{!! route('hotspots.create') !!}">Add New</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if ($hotspots->isEmpty())
                <div class="well text-center">No hotspots found.</div>
            @else
                <table class="table table-striped">
                    <thead>
                        <th>Name</th>
                        <th class="text-right" width="200px">Action</th>
                    </thead>
                    <tbody>
                        @foreach($hotspots as $hotspot)
                            <tr>
                                <td>
                                    <a href="{!! route('hotspots.edit', [$hotspot->id]) !!}">{{ $hotspot->name }}</a>
                                </td>
                                <td class="text-right">
                                    <form method="post" action="{!! route('hotspots.destroy', [$hotspot->id]) !!}">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this hotspot?')"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                    <a class="btn btn-default btn-xs pull-right raw-margin-right-16" href="{!! route('hotspots.edit', [$hotspot->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            {!! $hotspots; !!}
        </div>
    </div>

@stop