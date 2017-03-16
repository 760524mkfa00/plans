@extends('../layouts.app')

@section('content')

    <div class="container" role="main">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles...</div>

                    <div class="panel-body">
                        <h4>{{ $role->name }}</h4>
                        <div class="row">
                            <div class="col-md-12">
                                @if($user->hasRole('Admin'))
                                    <form action="{{ route('roles.update', [$role->id]) }}" class="form-horizontal details" method="post" role="form" accept-charset="UTF-8" autocomplete="off">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-xs-12">
                                                @include("./users/assign")
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <p>You have no access</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection