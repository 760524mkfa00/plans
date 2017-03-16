@extends('../layouts.app')

@section('content')

    <div class="container" role="main">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        @include('./_partials/error')
                        @include('./_partials/message')
                        @if($user->hasRole('Admin'))
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            First Name
                                        </th>
                                        <th>
                                            Last Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $user)
                                            <tr>
                                                <td>
                                                    {{ $user->id }}
                                                </td>
                                                <td>
                                                    {{ $user->first_name }}
                                                </td>
                                                <td>
                                                    {{ $user->last_name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ URL::route('register') }}" class="btn btn-default">New User</a>

                        @else
                            <p>You have no access</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
