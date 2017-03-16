@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @include('./_partials/error')
                @include('./_partials/message')
                <h1>{{ $building->building_name }}</h1>
                <p>{{ $building->street . ', ' . $building->town . ', ' . $building->postal }}</p>
                <p>{{ $building->description }}</p>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        @foreach($building->pictures->chunk(4) as $set)
                            <div class="row">
                                @foreach($set as $picture)
                                    <div class="col-md-3">
                                        <a href="{{ asset($picture->path) }}" data-lity>
                                            <img src="{{ asset($picture->thumbnail_path) }}" alt="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>Location</th>
                                <th>Type</th>
                                <th>File Name</th>
                                <th>File Type</th>
                                <th>File</th>
                                </thead>
                                @foreach($building->plans as $plan)
                                    <tr>
                                        <td>{{ $plan->floors->name }}</td>
                                        <td>{{ $plan->types->name }}</td>
                                        <td>{{ $plan->name }}</td>
                                        @if($plan->file_type <> "pdf")
                                            <td style="color:blue"><i
                                                        class="fa fa-pencil-square-o"></i> {{$plan->file_type}}</td>
                                        @else
                                            <td style="color:red"><i
                                                        class="fa fa-file-{{$plan->file_type}}-o"></i> {{$plan->file_type}}
                                            </td>
                                        @endif
                                        <td><a href="{{ route('plan.download', [$plan->id])  }}">Download File</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <form method="POST" action="{{ route('plan.upload') }}" enctype="multipart/form-data" class="form form-inline">
                            {{ csrf_field() }}
                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                            <input type="hidden" name="buildingName" value="{{ $building->building_name }}">
                            <input type="hidden" name="building_id" value="{{ $building->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="file" name="diagram">
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="file_name">File Name</label>
                                        <input type="text" class="form-control" id="file_name" name="file_name" placeholder="File name" value="{{ old('file_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="floor_id">Location</label>
                                        <input type="text" class="form-control" id="floor_id" name="floor_id" placeholder="Floor" value="{{ old('floor_id') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="type_id">Type</label>
                                        <input type="text" class="form-control" id="type_id" name="type_id" placeholder="Type" value="{{ old('type_id') }}">
                                    </div>
                                    <button type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
<hr/>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection