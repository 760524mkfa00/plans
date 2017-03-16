@extends('../layouts.app')

@section('content')

    <div class="container" role="main">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles...</div>

                    <div class="panel-body">
                        <h4>Roles</h4>
                        <div class="">
                            <div class="col-md-12">
                                @include('./_partials/error')
                                @include('./_partials/message')
                            </div>
                        </div>

                        @if($user->hasRole('Admin'))
                            <div class="">
                                <div class="">
                                    <div class="col-md-12">
                                        <h3>Add Role</h3>
                                        <form action="{{ url('/roles') }}" class="form-horizontal details" method="post" role="form" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                <label class="sr-only" for="name">Role</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Role..."  >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="active" value="Yes" type="hidden">
                                            <button type="submit" class="btn btn-primary pull-right">Add</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Roles</h4>
                                        @foreach($data as $role)
                                            <div class="col-md-4"><strong>Role</strong></div>
                                            <div class="col-md-4">{{ $role->name }}</div>
                                            <div class="col-md-4"><a href="{{ url("roles/edit", $role->id) }}">edit</a></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>You have no access</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection