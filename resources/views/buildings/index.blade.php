@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Buildings</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Building Name</th>
                                <th>Address</th>
                                <th>Building Type</th>
                            </thead>
                            <tbody>
                                @foreach($buildings as $building)
                                    <tr>
                                        <td><a href="{{ route('building.show', [$building]) }}">{{ $building->building_name }}</a></td>
                                        <td>{{ $building->street }}</td>
                                        <td>{{ $building->building_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($user->hasRole('Manager'))
                            <a class="btn btn-primary" href="{{ route('building.create') }}">New Building</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection