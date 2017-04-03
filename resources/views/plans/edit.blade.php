@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('plan.update', [$plan]) }}"
                      class="form form-inline">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">File Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="File name" value="{{ $plan->name }}">
                            </div>
                            <div class="form-group">
                                <label for="floor_id">Location</label>
                                {{ dropDownHelper('floor_id', $floors, $plan->floor_id, array('class' => 'form-control', 'id' => 'floor_id')) }}
                            </div>
                            <div class="form-group">
                                <label for="type_id">Type</label>
                                {{ dropDownHelper('type_id', $types, $plan->type_id, array('class' => 'form-control', 'id' => 'type_id')) }}
                            </div>
                            <button type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection